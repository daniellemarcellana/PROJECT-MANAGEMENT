<html>

<head>
    <style>
        .box {
            width: auto;
            z-index: 0;
            position: relative;
            display: inline-block;
            padding: 20px 150px;
            background-color: #130f40;
            background-image: linear-gradient(315deg, #130f40 0%, #000000 74%);
            border-radius: 5px;
            text-decoration: none;
            color: white;
            margin-top: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: 0.5s;
        }

        a,
        p {
            font-size: 25px;
            color: whitesmoke;
        }

        .divider {
            border-top: 8px solid #130f40;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <center>
        <div class="container">
            <div class="box">

                <p>Dear User,</p>
                <p>Please use this link to reset your account password.</p>
                <div class="divider" style="margin: 15px;"></div>
                <a href="{{ route('reset.password.get', $token) }}" style="font-weight: bold; font-size:35px;">Reset Password</a>
                <div class="divider" style="margin: 15px;"></div>
                <p>If you didn't recently attempt to login with this email address, you can safely disregard this email.</p>

                <a>Yours truly,<p>The Synapse Team</p></a>

            </div>
        </div>
    </center>
</body>

</html>