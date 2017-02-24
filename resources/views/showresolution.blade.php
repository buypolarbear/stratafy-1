<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stratafy - Resolution - {{$resolution->description}}</title>

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
                font-size: 40px;
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
                @if (!$owner)
                    <a href="{{ url('/resolutions') }}">Resolutions</a>
                @else
                    <a href="{{ url('/?unit='.$owner->unit) }}">Resolutions</a>
                @endif
            </div>

            <div class="content">
                <div class="title m-b-md">
                    {{$resolution->description}}
                </div>

                <div style="color: red">
                    {{session('error')}}
                </div>

                @if ($owner && $resolution->status=='open')
                    <div class="header m-b-md">
                        Your vote for Unit {{ $owner->unit }} <br/>
                        <form action="/resolutions/{{$resolution->id}}/vote/{{$owner->id}}" method="POST">
                          {{csrf_field()}}
                          <input type="radio" name="vote" value="yay" @if ($owner->pivot->vote == 'yay')
                              checked
                          @endif > Yay<br/>
                          <input type="radio" name="vote" value="nay" @if ($owner->pivot->vote == 'nay')
                              checked
                          @endif > Nay<br/>
                          <input type="radio" name="vote" value="abstain" @if ($owner->pivot->vote == 'abstain')
                              checked
                          @endif > Abstain<br/>
                          <input type="submit" name="submit">
                        </form>
                    </div>
                @endif

                <div class="links">
                    Expires at: {{$resolution->expire_at}}<br/>
                    Status: {{$resolution->status}}<br/>
                </div>

                <table border="1" cellpadding="0" cellspacing="0" width="100%">
                    <tr><th>Unit</th><th>Vote</th><th>Time</th></tr>
                    @foreach ($resolution->owners as $unitowner)
                    <tr>
                        <td>{{$unitowner->unit}}</td>
                        <td style=@if ($unitowner->pivot->vote == 'yay')
                                "background-color:green;color:white"
                            @elseif ($unitowner->pivot->vote == 'nay')
                                "background-color:red;color:white"
                            @else
                                "background-color:white;color:black"
                            @endif >{{$unitowner->pivot->vote}}
                        </td>
                        <td>{{$unitowner->pivot->updated_at}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
