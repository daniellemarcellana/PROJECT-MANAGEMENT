<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/component.css') }}" />
    <script src="js/modernizr.custom.js"></script>
</head>

<body class="bg-dark">
    <center>
        <div class="container">
            <div class="main">
                <ul id="bk-list" class="bk-list clearfix">
                    <li style="z-index: 1;">
                        <div class="bk-book book-1 bk-viewinside">
                            <div class="bk-front">
                                <div class="bk-cover-back"></div>
                                <div class="bk-cover">
                                    <h2>
                                        <span>Reset Password</span>
                                        <div class="divider"></div>
                                        <span>Check your Email</span>
                                    </h2>
                                </div>
                            </div>
                            <div class="bk-page">
                                <div class="bk-content bk-content-current">
                                    <form method="POST" action="{{ route('forget.password.post') }}">
                                        @csrf

                                        <div class="inputs">
                                            <label for="email" class="label">Enter email below</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $errors->first('email') }}" required autofocus>
                                        </div>
                                        <div class="buttons">
                                            <button type="submit" class="bk-bookview bk-active submit">Send Password Reset Link</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="bk-back">
                            </div>
                            <div class="bk-right"></div>
                            <div class="bk-left"></div>
                            <div class="bk-top"></div>
                            <div class="bk-bottom"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- /container -->
    </center>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/books1.js"></script>
    <script>
        $(function() {
            Books.init();
        });
    </script>
</body>

</html>