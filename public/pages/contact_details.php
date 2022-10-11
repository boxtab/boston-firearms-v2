<!doctype html>
<html>

<head>
    <title>contact_details</title>
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
                    <a href="/" title="Boston firearms" class="logo-03"></a>
                </div>
            </div>

            <div class="tabs">
                <div class="titles">
                    <div class="title title2 ">
                        Schedule A Class
                    </div>
                    <div class="title title2 current">
                        Enter Details
                    </div>
                    <div class="title title2 ">
                        Make Payment
                    </div>
                </div>
                <div class="cols">
                    <div class="col col3 passed"></div>
                    <div class="col col3 current"></div>
                    <div class="col col3 "></div>
                </div>
            </div>
        </div>

        <div class="desktop-wide-wrap ">
            <div class="container ">

                <div class="due-today">
                    <div class="text">
                        <h3>Amount due today </h3>
                        <p>Rest of balance paid the day of class</p>
                    </div>
                    <div class="amount">
                        $40.00
                    </div>
                </div>
                <form id="quiz-contact-details-form" action="" method="post">
                    <input type="hidden" name="_nonce" value="">
                    <input type="hidden" name="action" value="contact-details">
                    <input type="hidden" name="reserved_timer" value="" id="quiz-reserved-timer">

                    <div class="input-title">
                        First Name
                    </div>
                    <div class="input-block">
                        <input type="text" name="first_name" required placeholder="Enter Name" value="">
                    </div>

                    <div class="input-title">
                        Last Name
                    </div>
                    <div class="input-block">
                        <input type="text" name="last_name" required placeholder="Enter Your Last Name" value="">
                    </div>

                    <div class="input-title">
                        Mobile Phone
                    </div>
                    <div class="input-block">
                        <input type="text" name="phone" required placeholder="Enter Phone Number" value="">
                    </div>

                    <div class="input-title">
                        Email Address
                    </div>
                    <div class="input-block">
                        <input type="email" name="email" required placeholder="Enter Email" value="">
                    </div>

                    <div class="button-row">
                        <button type="submit" class="button" style="border: none">
                            Next
                        </button>
                    </div>
                </form>

            </div>
        </div>


    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="/js/quiz-contact-details.js" type="text/javascript"> </script>
    <script>

    </script>
</body>

</html>