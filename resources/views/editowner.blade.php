<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stratafy - Edit Owner Record - {{$owner->unit}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="top-right links">
                <a href="{{ url('/owners') }}">Owners Records</a>
            </div>

            <div class="content">
                <div class="title m-b-md">
                    Edit Owner Record
                </div>

                <div style="color: red">
                    {{session('error')}}
                </div>

                <div class="links">
                    <form action="/owners/{{$owner->id}}" method='POST'>
                        {{csrf_field()}}
                        Unit: {{$owner->unit}}<br/>
                        Name: <input name="name" value="{{ old('name') ?: $owner->name}}"/><br/>
                        <input type='submit' name="submit"/><br/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>