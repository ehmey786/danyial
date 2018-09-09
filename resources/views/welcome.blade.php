<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SME BusinessMen Services</title>

        <link rel="apple-touch-icon" href="{{url('img/sme-logo.jpg')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 90vh;
                margin: 0;
            }

            .full-height {
                height: 87vh;
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
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/tasks') }}">Tasks </a>
                        <a href="{{ url('/companies') }}">Companies </a>
                        <a href="{{ url('/notifications') }}">Notifications </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    SME Businessmen Services <br>
                    <b><small style="font-size:14px">Tasks <label class="label label-primary">{{$data['task_count']}}</label> - </small>  <small style="font-size:14px">Companies <label class="label label-primary">{{$data['company_count']}}</label> - </small> <small style="font-size:14px">Employees <label class="label label-primary">{{$data['employee_count']}}</label> - </small>  <small style="font-size:14px">Files <label class="label label-primary">{{$data['files_count']}}</label> </small></b>
                </div>

            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <hr style="margin-bottom: 20px;">
        <footer style="text-align: center;position: absolute;width: 100%;bottom: 15;">
            <p style="padding-bottom:18px;">    Powered by <span style="color:darkorange;"><b>Avast</b></span></p>
        </footer>
    </body>
</html>
