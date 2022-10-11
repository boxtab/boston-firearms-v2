<!doctype html>
<html>

<head>
    <title>Payment 2</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css"> -->
    <link href="/css/full-height.css" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="page page-payment">

        <div class="header">
            <div class="action-row">
                <div class="desktop-wide-wrap">
                    <a href="/" title="Boston firearms" class="logo-03">
                </div>
            </div>
        </div>
        <div class="tabs">
            <div class="titles">
                <div class="title title2 ">
                    Schedule A Class
                </div>
                <div class="title title2 ">
                    Enter Details
                </div>
                <div class="title title2 current">
                    Make Payment
                </div>
            </div>
            <div class="cols">
                <div class="col col3 passed"></div>
                <div class="col col3 passed"></div>
                <div class="col col3 current"></div>
            </div>
        </div>
    </div>
    <div class="desktop-wide-wrap">
        <div class="container">

            <div class="due-today">
                <div class="text">
                    <h3>Amount due today </h3>
                    <p>Rest of balance paid the day of class</p>
                </div>
                <div class="amount">
                    $40.00
                </div>
            </div>


            <div class="important double">
                <div class="text">
                    Due to high demand, <br>
                    your spot is reserved for :
                </div>
                <div class="time">
                    10:10
                </div>
            </div>

            <div id="quiz-payment-form" style="position: relative">
                <div id="sq-payment-overlay" style="">
                    <div class="overlay__inner">
                        <div class="overlay__content"><span class="spinner"></span></div>
                    </div>
                </div>
                <form>
                    <div class="input-title">
                        Select a payment method
                    </div>

                    <div class="input-block card" id="sq-apple-pay" style="cursor: pointer; display: none">
                        <div class="ico">
                            <img src="/ico/card/apple-pay.png" alt="">
                        </div>
                        <div class="card-title" style="">
                            Pay via Apple Pay
                            <a class="payment-type-block"></a>
                        </div>
                    </div>
                </form>
                <form>
                    <div class="input-block card" id="sq-google-pay" style="cursor: pointer">
                        <div class="ico">
                            <img src="/ico/card/google-icon.png" alt="">
                        </div>
                        <div class="card-title" style="">
                            Pay via Google Pay
                            <a class="payment-type-block"></a>
                        </div>
                    </div>

                </form>

                <form action="/payment-finish" method="post">
                    <div class="input-block card active" id="credit-card-parent">
                        <div class="ico">
                            <img src="/ico/card/credit-card.png" alt="">
                        </div>
                        <div class="card-title" style="">
                            Pay via Credit Card
                            <a class="payment-type-block"></a>
                        </div>
                    </div>
                    <div class="input-block-opened" id="credit-card-panel">

                        <div class="input-title">
                            Name on the card
                        </div>
                        <div class="input-block">
                            <input type="text" id="card-name" placeholder="Enter the name on the card">
                        </div>

                        <div class="input-title">
                            Card Number
                        </div>
                        <div class="input-block">
                            <input type="text" id="sq-card-number" placeholder="Enter the the card number">
                        </div>

                        <div class="input-cols">
                            <div class="input-col3">
                                <div class="input-title">
                                    Valid Through
                                </div>
                                <div class="input-block">
                                    <input id="sq-expiration-date" type="text" placeholder="DD/MM">
                                </div>
                            </div>
                            <div class="input-col3">

                                <div class="input-title">
                                    CVV
                                </div>
                                <div class="input-block">
                                    <input id="sq-cvv" type="text" placeholder="Security Code">
                                </div>
                            </div>
                            <div class="input-col3">
                                <div class="input-title">
                                    Postal Code
                                </div>
                                <div class="input-block">
                                    <input id="sq-postal-code" type="text" placeholder="Postal Code">
                                </div>
                            </div>

                        </div>
                        <div class="button-row">
                            <div id="card-pay-button" class="button">
                                Proceed
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="sq-payment-form" action="#" method="post" style="display: none">
        <input type="hidden" name="sq_nonce" id="sq-nonce">
        <input type="hidden" name="sq_zip" id="postal-code">
        <input type="hidden" name="_nonce" value="#">
        <input type="hidden" name="action" value="process-payment">
        <input type="hidden" name="reserved_timer" value="#" id="quiz-reserved-timer">
    </form>

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="/js/quiz-payment.js" type="text/javascript"> </script>
</body>

</html>