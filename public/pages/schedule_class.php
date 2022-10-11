<!doctype html>
<html>

<head>
    <title>Schedule class</title>
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
                    <a href="/" title="Boston firearms"  class="logo-03"></div>
                </div>
            </div>

            <div class="tabs">
                <div class="titles">
                    <div class="title title2 current">
                        Schedule A Class
                    </div>
                    <div class="title title2 ">
                        Make Payment
                    </div>
                </div>
                <div class="cols">
                    <div class="col col2 current"></div>
                    <div class="col col2 "></div>
                </div>
            </div>
        </div>
        <div class="desktop-wide-wrap">
            <div class="container">

                <form id="quiz-schedule-form" action="#" method="post">
                    <input type="hidden" name="_nonce" value="">
                    <input type="hidden" name="action" value="schedule-class">
                    <div class="input-title">
                        Pick Your Course
                    </div>
                    <div class="select-block">
                        <select name="event_id" id="quiz-event-id">
                            <option value="-1">Select</option>

                        </select>
                    </div>
                    <div class="input-title">
                        Date & Time
                    </div>
                    <div class="select-block">
                        <select name="event_day_id" id="quiz-event-day_id">
                            <option value="-1">Select</option>
                        </select>
                    </div>

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
    <script src="/js/schedule.js" type="text/javascript"> </script>

</body>

</html>
