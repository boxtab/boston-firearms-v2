(function ($) {
    $(document).ready(function () {
        // Payment page tabs START

        if ($('#payment-page-tabs').length) {
            $('.payment-tab').click(function () {
                if ($(this).hasClass('active')) {
                    // nothing
                } else {
                    $('.payment-tab.active').removeClass('active');
                    $('form.form-active').removeClass('form-active');
                    $(this).addClass('active');
                    $('#' + $(this).attr('name')).addClass('form-active');
                }
            });
        }
        // Payment page tabs START

        // let allParents = $('#credit-card-parent'); //$('#quiz-payment-form > form > div.input-block.card');
        // let allPanels = $('#credit-card-panel'); //$('#quiz-payment-form > form > div.input-block-opened').hide();
        let allParents = $('.input-block.card');
        let allPanels = $('.form-block');
        let allTabs = $('.tabs-row .tab');

        $('#payment-form > form > div.card a.payment-type-block').click(
            function () {
                let $this = $(this);
                let $target = $this.parent().parent().next();
                let $parent = $this.parent().closest('.card');

                if (!$target.hasClass('active')) {
                    allPanels.removeClass('active').slideUp();
                    $target.addClass('active').slideDown();
                    allParents.removeClass('active');
                    $parent.addClass('active').slideDown();
                }

                return false;
            }
        );

        $('.tabs-row .tab').click(function () {
            let $this = $(this);
            let $target = $('.form-block.' + $this.attr('panel'));

            if (!$target.hasClass('active')) {
                let paymentGatewayId = $target
                    .parent()
                    .find('input[name="payment_gateway_id"]')
                    .val();
                if (!isNaN(paymentGatewayId)) {
                    $('#payment-gateway-id').val(paymentGatewayId);
                }
                allPanels.removeClass('active').slideUp();
                allTabs.removeClass('active');
                $this.addClass('active');
                $target.addClass('active').slideDown();
                allParents.removeClass('active');
                //$parent.addClass('active').slideDown();
            }

            return false;
        });
    });
    function adjustMobilePaymentTool(tool, state) {
        if (state) {
            $('#' + tool + '-payment-tab').show();
            $('#' + tool + '-payment-form').show();
        } else {
            $('#' + tool + '-payment-tab').hide();
            $('#' + tool + '-payment-form').hide();
        }
    }
    // Create and initialize a payment form object
    const paymentForm = new SqPaymentForm({
        // Initialize the payment form elements
        applicationId: paymentParams.applicationId,
        locationId: paymentParams.locationId,
        inputClass: 'sq-input',
        autoBuild: false,
        // Customize the CSS for SqPaymentForm iframe elements
        inputStyles: [
            {
                fontSize: '16px',
                lineHeight: '24px',
                padding: '16px 0 16px 16px',
                placeholderColor: '#a0a0a0',
                backgroundColor: '#fff',
            },
        ],
        googlePay: {
            elementId: 'sq-google-pay',
        },
        // Initialize Web Apple Pay placeholder ID
        applePay: {
            elementId: 'sq-apple-pay',
        },
        // Initialize the credit card placeholders
        cardNumber: {
            elementId: 'sq-card-number',
            placeholder: 'Card Number',
        },
        cvv: {
            elementId: 'sq-cvv',
            placeholder: 'CVV',
        },
        expirationDate: {
            elementId: 'sq-expiration-date',
            placeholder: 'MM/YY',
        },
        postalCode: {
            elementId: 'sq-postal-code',
            placeholder: 'Postal Code',
        },

        // SqPaymentForm callback functions
        callbacks: {
            /*
             * callback function: cardNonceResponseReceived
             * Triggered when: SqPaymentForm completes a card nonce request
             */
            cardNonceResponseReceived: function (errors, nonce, cardData) {
                if (errors) {
                    // Log errors from nonce generation to the browser developer console.
                    //console.error('Encountered errors:');
                    let returnErrors = '';
                    errors.forEach(function (error) {
                        console.error('  ' + error.message);
                        returnErrors += '\n' + error.message;
                    });
                    alert('Encountered errors:' + '\n' + returnErrors);
                    document.getElementById(
                        'sq-payment-overlay'
                    ).style.display = 'none';
                    return;
                }

                document.getElementById('sq-nonce').value = nonce;
                document.getElementById('postal-code').value =
                    cardData.billing_postal_code;
                document.getElementById('sq-payment-form').submit();
            },
            methodsSupported: function (methods, unsupportedReason) {
                console.log(methods);
                let googlePayBtn = document.getElementById('sq-google-pay');
                let applePayBtn = document.getElementById('sq-apple-pay');

                // Only show the button if Google Pay on the Web is enabled
                if (methods.applePay === true) {
                    applePayBtn.style.display = 'inline-block';
                    adjustMobilePaymentTool('apple', true);
                } else if (methods.googlePay === true) {
                    googlePayBtn.style.display = 'inline-block';
                    adjustMobilePaymentTool('google', true);
                } else {
                    console.log(unsupportedReason);
                }
            },

            /*
             * callback function: createPaymentRequest
             * Triggered when: a digital wallet payment button is clicked.
             */
            createPaymentRequest: function () {
                return {
                    requestShippingAddress: false,
                    requestBillingInfo: false,

                    currencyCode: 'USD',
                    countryCode: 'US',
                    total: {
                        label: paymentParams.chargeLabel,
                        amount: paymentParams.chargeAmount,
                        pending: false,
                    },
                    lineItems: [
                        {
                            label: 'Subtotal',
                            amount: paymentParams.chargeAmount,
                            pending: false,
                        },
                        {
                            label: 'Tax',
                            amount: '0',
                            pending: false,
                        },
                    ],
                };
            },
        },
    });
    paymentForm.build();
    $('#card-pay-button').click(function (e) {
        onGetCardNonce(e);
        return false;
    });
    function onGetCardNonce(event) {
        // Don't submit the form until SqPaymentForm returns with a nonce
        event.preventDefault();
        // Request a nonce from the SqPaymentForm object
        paymentForm.requestCardNonce();
        document.getElementById('sq-payment-overlay').style.display = 'block';
    }
})(jQuery);
