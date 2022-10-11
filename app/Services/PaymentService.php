<?php


namespace App\Services;


use App\Constants\PaymentConstants;
use App\Contracts\PaymentProcessor as PaymentProcessorContract;
use App\Events\PaymentCanceled;
use App\Events\PaymentFailed;
use App\Events\PaymentSucceeded;
use App\Models\Client;
use App\Models\Payment;
use App\PaymentProcessors\PaypalExpressProcessor;
use App\PaymentProcessors\SquareUpProcessor;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Pure;
use Omnipay\Common\Message\ResponseInterface;


class PaymentService {

    private PaymentProcessorContract $processor;
    private int $paymentGateway;

    private Payment $payment;

    public function __construct($gatewayId = PaymentConstants::GATEWAY_SQUARE_UP)
    {
        $this->paymentGateway = (int)$gatewayId;
        $this->processor = $this->getProcessor();
    }

    public function getPaymentByToken(string $token)
    {
        $payment = Payment::query()
                      ->where('payment_token', $token)
                      ->first();
        if (empty($payment)) {
            //throw payment error
        }

        $this->setPayment($payment);

        return $payment;
    }

    public function getPayment(): ?Payment
    {
        return !is_null($this->payment) ? $this->payment->refresh() : null;
    }

    public function setPayment(Payment $payment): PaymentService
    {
        $this->payment = $payment;
        return $this;
    }

    public function purchase( array $options ): ResponseInterface
    {
        $this->createPayment($options);
        $response = $this->processor->charge($this->preparePaymentData( $options ));
        $this->handlePaymentResponse($response);

        return $response;
    }

    public function confirmPurchase(array $options=[])
    {
        $payment = $this->getPaymentByToken($options['token']?? 'some id');

        if ( isset( $options[$this->processor->getCustomerReferenceField()] ) ) {
            $this->updateClientPaymentReference($payment->client, $options[$this->processor->getCustomerReferenceField()]);
        }
        $response = $this->processor->confirmCharge($this->preparePaymentData( $options ));

        $this->handlePaymentResponse($response);

        return $payment;
    }

    public function succeedPayment(ResponseInterface $response)
    {
        $payment = $this->getPayment();
        if (is_null($payment)) {
            //throw payment error
        }
        $payment->pushStatus(PaymentConstants::STATUS_SUCCEEDED);
        $data = $response->getData();
        $customerReference = $this->processor->getCustomerReference();
        if (!is_null($customerReference)) {
            $this->updateClientPaymentReference($payment->client, $customerReference);
        }

        $payment->update([
            'transaction_id' => $response->getTransactionReference(),
            'gateway_fee' => isset($data['PAYMENTINFO_0_FEEAMT']) ? $data['PAYMENTINFO_0_FEEAMT'] : 0.00
        ]);

        event(new PaymentSucceeded($payment));

    }

    public function cancelPayment(array $options = []): Payment
    {
        $payment = $this->getPayment();
        if (is_null($payment)) {
            $payment = $this->getPaymentByToken($options['token']?? 'some id');
        }
        //still didn't find the payment
        abort_if(is_null($payment), 404);

        $payment->pushStatus(PaymentConstants::STATUS_CANCELED);
        event(new PaymentCanceled($payment));

        return $payment;
    }

    public function failPayment(ResponseInterface $response)
    {
        $payment = $this->getPayment();

        abort_if(is_null($payment), 404);

        $payment->pushStatus(PaymentConstants::STATUS_FAILED);
        $payment->update([
            'errors' => $response->getMessage()
        ]);
        event(new PaymentFailed($payment));
    }

    protected function createPayment($options)
    {
        $payment = DB::transaction(function () use ( $options ) {
            return Payment::create( $this->mapPaymentOptions($options) );
        });
        $this->setPayment($payment);

        return $payment;
    }

    private function handlePaymentResponse(ResponseInterface $response)
    {
        $payment = $this->getPayment();

        if ($response->isRedirect()) {
            $payment->update([
                'payment_token' => $response->getTransactionReference()
            ]);
        } else if ($response->isSuccessful()){
            $this->succeedPayment( $response );
        } else if ($response->isCancelled()) {
            $this->cancelPayment();
        } else {
            $this->failPayment( $response );
        }
    }

    private function updateClientPaymentReference(Client $client, $reference)
    {
        $client->forceFill([
            PaymentConstants::GATEWAY_CUSTOMER_REFERENCE_FIELD[$this->paymentGateway] => $reference
        ])->save();
    }

    private function preparePaymentData(array $options ): array
    {
        $payment = $this->getPayment();
        $note = $options['note']?? null;
        if (is_null($note)) {
            if (!is_null($payment->booking)) {
                $note = $payment->booking->getDataForPayment()['note'];
            } else {
                $note = 'custom payment: ID#'.$payment->id;
            }
        }
        $result = [
            'payment' => $payment,
            'amount' => $payment->amount,
            'currency' => 'USD',
            'note' => $note,
            'customer' => [
                'reference'     => !is_null($payment->client) ? $payment->client->getAttributeValue(PaymentConstants::GATEWAY_CUSTOMER_REFERENCE_FIELD[$payment->gateway]) : null,
                'first_name'    => !is_null($payment->client) ? $payment->client->first_name : null,
                'last_name'     => !is_null($payment->client) ? $payment->client->last_name : null,
                'email'         => !is_null($payment->client) ? $payment->client->email : null,
                'phone'         => !is_null($payment->client) ? $payment->client->phone : null,
                'full_name'     => !is_null($payment->client) ? $payment->client->full_name_format : null
            ],

        ];

        return array_merge($result, $this->mapProcessorOptions($options));
    }

    private function mapProcessorOptions( array $options ): array
    {
        $result = [
            'sq_nonce' => $options['sq_nonce'] ?? null,
            'token' => $options['token']?? null,
        ];
        if (isset($options[$this->processor->getCustomerReferenceField()])) {
            $result['customer']['reference'] = $options[$this->processor->getCustomerReferenceField()];
        }

        return $result;
    }

    private function mapPaymentOptions(array $options): array
    {
        $payment = new Payment();

        return array_intersect_key(
            $options,
            array_flip(
                $payment->getFillable()
            )
        );
    }

    /**
     * @return PaymentProcessorContract
     */
    private function getProcessor(): PaymentProcessorContract
    {
        if ($this->paymentGateway == PaymentConstants::GATEWAY_SQUARE_UP) {
            return new SquareUpProcessor();
        } else if ($this->paymentGateway == PaymentConstants::GATEWAY_PAYPAL) {
            return new PaypalExpressProcessor();
        }

        return new SquareUpProcessor();
    }

}
