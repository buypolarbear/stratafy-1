<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stratafy</title>

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

            .header {
                font-size: 40;
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

            <div class="content">
                <div class="title m-b-md">
                    What is your unit number?
                </div>

                <div class="header m-b-md">
                    <form>
                        Unit: <input name="unit" value="{{($owner ? $owner->unit : '')}}">
                        <input type="submit" name="submit">
                    </form>
                </div>

                <table border="1" cellpadding="0" cellspacing="0" width="100%">
                    <tr><th>Description</th><th>Expiration</th><th>Status</th></tr>
                    @foreach ($resolutions as $resolution)
                    <tr>
                        <td><a href="{{ url('/resolutions/'.$resolution->id.'/vote/'.$owner->id) }}">{{$resolution->description}}</a></td>
                        <td>{{$resolution->expire_at}}</td>
                        <td>{{$resolution->status}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
