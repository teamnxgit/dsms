<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DSMS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }
            .Button {
                box-shadow:inset 0px 1px 0px 0px #54a3f7;
                background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%);
                background-color:#007dc1;
                border-radius:3px;
                border:1px solid #124d77;
                display:inline-block;
                cursor:pointer;
                color:#ffffff;
                font-family:Arial;
                font-size:13px;
                padding:6px 24px;
                text-decoration:none;
                text-shadow:0px 1px 0px #154682;
            }
            .Button:hover {
                background:linear-gradient(to bottom, #0061a7 5%, #007dc1 100%);
                background-color:#0061a7;
            }
            .Button:active {
                position:relative;
                top:1px;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div>
                    <img src="images/logo.png" alt="">
                </div>
                <h1 class="">
                    Divisional Secretariat Management System
                </h1>

                <h4 class="">
                    Koralaipattu West - Oddamavadi
                </h4>

                <div>
                    <a href="/login" class="Button">Login Page</a>
                </div>

            </div>
        </div>
    </body>
</html>
