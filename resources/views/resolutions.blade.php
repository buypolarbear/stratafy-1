<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stratafy - Resolutions</title>

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
                    <a href="{{ url('/resolutions/create') }}">Add Resolutions</a>
            </div>
            <div class="content">
                <div class="title m-b-md">
                    Resolutions
                </div>

                <table border="1" cellpadding="0" cellspacing="0" width="100%">
                    <tr><th>Description</th><th>Expiration</th><th>Status</th><th>&nbsp;</th></tr>
                    @foreach ($resolutions as $resolution)
                    <tr>
                        <td><a href="{{ url('/resolutions/'.$resolution->id) }}">{{$resolution->description}}</a></td>
                        <td>{{$resolution->expire_at}}</td>
                        <td>{{$resolution->status}}</td>
                        <td><a href="{{ url('/resolutions/'.$resolution->id.'/edit') }}">Edit</a></td>
                    </tr>
                    @endforeach
                </table>
                @if ($resolutions->isEmpty())
                    <div style="color: red">
                        No records found
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
