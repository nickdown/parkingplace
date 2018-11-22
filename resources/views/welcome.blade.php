<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .flex-center {
                display: flex;
                justify-content: center;
            }

            .content {
                padding-top: 40px;
                padding-bottom: 40px;
                text-align: center;
                width: 75%;
            }

            .title {
                font-size: 84px;
            }

            .subtitle {
                font-size: 42px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 15px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 20px;
            }

            .m-t-md {
                margin-top: 40px;
            }

            .button {
                border: none;
                color: white;
                margin: 30px;
                padding: 15px 30px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 25px;
                border-radius: 4px;
            }

            .button-primary {
                background-color: #636b6f;
            }

            .button-secondary {
                background-color: #1E407C;
            }
        </style>
    </head>
    <body>
        <div class="flex-center">
            <div class="content">
                @if (Route::has('login'))
                    <div class="links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <div class="title m-b-md m-t-md">
                    Parking Place
                </div>

                <div class="subtitle m-b-md">
                    <p>Welcome to the easiest way to park!</p>
                    <p>You can enter, pay, and leave the garage with just your phone.</p>
                </div>
                 @if (Route::has('login'))
                        @auth
                            <a href="{{ route('register') }}" class="button button-secondary">Go To Ticket Dashboard</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="button button-primary">Create Your Free Account</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
