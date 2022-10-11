@extends('layout.page_default')

@section('title', __('Payment'))

@section('page_wrapper_class', 'page-request')

@section('content')
<div class="request-payment">
    <div class="desktop-wide-wrap">
        @include('errors.payment-error')
        <div class="payment-form">
            <h1>
                Checkout
            </h1>
            <div class="fields-row amount">
                <h3>
                    Amount You've Paid
                </h3>
                <div class="cost-row">
                    ${{ $amountToday }}
                </div>
            </div>
            <h2>
                Personal Information
            </h2>
            <div class="fields-row">
                <div class="field-wrap">
                    <label for="first-name">First Name</label>
                    <input type="text"
                           name="client[first_name]"
                           value="{{ $booking->client->first_name }}"
                           id="first-name"
                           maxlength="255"
                           required
                           placeholder="Enter Name"
                    >
                </div>
                <div class="field-wrap">
                    <label for="last-name">Last Name</label>
                    <input type="text"
                           name="client[last_name]"
                           value="{{ $booking->client->last_name }}"
                           id="last-name"
                           maxlength="255"
                           required
                           placeholder="Enter Your Last Name"
                    >
                </div>
            </div>
            <div class="fields-row">
                <div class="field-wrap">
                    <label for="phone">Mobile Phone</label>
                    <input type="text"
                           name="client[phone]"
                           value="{{ $booking->client->phone }}"
                           id="phone"
                           maxlength="64"
                           required
                           placeholder="Enter Phone Number"
                    >
                </div>
                <div class="field-wrap last">
                    <label for="email">Email Address</label>
                    <input type="email"
                           name="client[email]"
                           value="{{ $booking->client->email }}"
                           id="email"
                           maxlength="255"
                           required
                           placeholder="Enter Email"
                    >
                </div>
            </div>
            <h2>
                Select a Payment Method
            </h2>


            <div class="payments-row" id="payment-page-tabs">

                <div class="payment-tabs">
                    <div class="payment-tab card-tab active" name="make-payment-form">
                        <img src="/images/2022/request/credit-card.png" alt="">
                        <span>Credit card</span>
                    </div>
                    <div class="payment-tab" name="sq-paypal">
                        <img src="/images/2022/request/paypal.png" alt="">
                    </div>
                    <div class="payment-tab" name="apple-payment-form">
                        <img src="/images/2022/request/apple-pay.png" alt="">
                    </div>
                    <div class="payment-tab" name="google-payment-form">
                        <img src="/images/2022/request/google-pay-primary-logo.png" alt="">
                    </div>

                </div>
            </div>

            <style>
                /* #google-payment-form {
                    display: none !important;
                } */
            </style>
            <form id="google-payment-form" action="{{ route('certificate.payment.store', ['booking' => $booking->id]) }}" method="post">
                @csrf
                <input type="hidden" name="gateway" value="{{ \App\Constants\PaymentConstants::GATEWAY_SQUARE_UP }}">
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <div class="fields-row">
                    <div class="btn-row">
                        <div class="button" id="sq-google-pay">
                            Proceed to Pay
                        </div>
                    </div>
                </div>
            </form>

            <form id="apple-payment-form" action="{{ route('certificate.payment.store', ['booking' => $booking->id]) }}" method="post">
                @csrf
                <input type="hidden" name="gateway" value="{{ \App\Constants\PaymentConstants::GATEWAY_SQUARE_UP }}">
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <div class="fields-row" id="sq-apple-pay">
                    <div class="btn-row">
                        <button type="submit" class="button">
                            Proceed to Pay
                        </button>
                    </div>
                </div>
            </form>

            <form id="sq-paypal" action="{{ route('certificate.payment.store', ['booking' => $booking->id]) }}" method="post">
                @csrf
                <input type="hidden" name="gateway" value="{{ \App\Constants\PaymentConstants::GATEWAY_PAYPAL }}">
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <input type="hidden" name="type" value="{{ \App\Constants\PaymentConstants::TYPE_CERTIFICATE }}">
                <div class="fields-row">
                    <div class="btn-row">
                        <button class="button" type="submit">
                            Proceed to Pay
                        </button>
                    </div>
                </div>
            </form>

            <form id="make-payment-form" class="form-active" action="{{route('certificate.payment.store', ['booking' => $booking])}}" method="post" style="">
                <div class="fields-row">
                    <div class="field-wrap">
                        <label for="sq-card-number">Credit Card No.</label>
                        <input type="text"
                               id="sq-card-number"
                               name="card[number]"
                               maxlength="25"
                               required
                               placeholder="Enter the the card number"
                        >
                    </div>
                    <div class="field-wrap card master">
                        <label for="card-name">Name on the card</label>
                        <input type="text"
                               id="card-name"
                               name="card[name]"
                               maxlength="255"
                               required
                               placeholder="Enter the name on the card"
                        >
                        <div class="master-ico">
                            <img src="/images/2022/request/mastercard.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="fields-row">
                    <div class="field-wrap">
                        <label for="sq-expiration-date">Expiration</label>
                        <input id="sq-expiration-date"
                               type="text"
                               name="card[expiration_date]"
                               maxlength="5"
                               required
                               placeholder="MM/YY"
                        >
                    </div>
                    <div class="field-wrap last">
                        <label for="sq-cvv">Security Code (CVV)</label>
                        <input id="sq-cvv"
                               type="text"
                               name="card[cvv]"
                               maxlength="3"
                               required
                               placeholder="XXX"
                        >
                    </div>

                </div>
                <div class="fields-row">
                    <div class="field-wrap">
                        <label for="sq-postal-code">Postal Code</label>
                        <input id="sq-postal-code"
                               type="text"
                               name="card[postal_code]"
                               placeholder="Postal Code"
                        >
                    </div>
                </div>

                <div class="fields-row">
                    <div class="btn-row">
                        <button type="submit" class="button" id="card-pay-button">
                            Proceed to Pay
                        </button>
                    </div>
                    <div class="ssl">
                        <img src="/images/2022/request/ssl.png" alt="">
                    </div>
                </div>

                @csrf
            </form>
        </div>
        <form id="sq-payment-form" action="{{ route( 'certificate.payment.store', ['booking' => $booking->id] ) }}" method="post" style="display: none">
            @csrf
            <input type="hidden" name="sq_nonce" id="sq-nonce">
            <input type="hidden" name="sq_zip" id="postal-code">
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <input type="hidden" name="type" value="{{ \App\Constants\PaymentConstants::TYPE_CERTIFICATE }}">
            <input type="hidden" name="gateway" value="{{ \App\Constants\PaymentConstants::GATEWAY_SQUARE_UP }}" id="payment-gateway-id">
        </form>

    </div>
</div>

@include('includes.footer.location-row')
@stop

@push('footer-scripts')
<script type="text/javascript">
    const paymentParams = {
        "chargeLabel": "{{ $booking->appointment->event->title }}",
        "chargeAmount": "{{ $booking->appointment->getInitialAmount() }}",
        "applicationId": "{{ env('SQUARE_APP_ID') }}",
        "locationId": "{{ env('SQUARE_LOCATION_ID') }}"
    }
</script>
<script src="https://js.squareupsandbox.com/v2/paymentform" type="text/javascript"></script>
<script src="/js/payment.js" type="text/javascript"> </script>
@endpush
