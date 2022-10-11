<!doctype html>
<html>

<head>
    <title>Client Info</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css"> -->
    <link href="/css/full-height.css" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="page page-finish">
        <div class="desktop-wide-wrap">
            <div class="action-row">
                <a href="/" title="Boston firearms" class="logo-03"></a>
            </div>

            <form id="customer-info" action="#" method="post">
                <input type="hidden" name="_nonce" value="">
                <input type="hidden" name="action" value="client-info">
                <div class="title">
                    <strong class="main">
                        Enter Your Email
                    </strong>
                    <strong>
                        to see results
                    </strong>
                </div>

                <div class="input-title">
                    First Name
                </div>
                <div class="input-block">
                    <input type="text" name="first_name" placeholder="Enter Your First Name" required>
                </div>
                <div class="input-title">
                    Last Name
                </div>
                <div class="input-block">
                    <input type="text" name="last_name" placeholder="Enter Your Last Name" required>
                </div>

                <div class="input-title">
                    Email
                </div>
                <div class="input-block">
                    <input type="email" name="email" placeholder="Enter Your Email" required>
                </div>
                <div class="button-row result">
                    <button type="submit" class="button" style="border: none">
                        See Results
                    </button>
                </div>
            </form>
            <div class="footer-small">
                <p>
                    If you have any questions please call us at
                </p>
                <p>
                    <a href="tel:(617) 944-0985">
                        (617) 944-0985
                    </a>
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#customer-info').submit(function() {
                fbq('track', 'lead')
            })
        })
    </script>
</body>

</html>