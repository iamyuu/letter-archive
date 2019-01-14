<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sigin | Y-Archive</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/materialize/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/material%20icon/icon-material.css') }}">
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row" style="margin-top: 5%;">
                <div class="col s12 m3"></div>
                <div class="col s12 m6">
                    <div class="card-panel">
                        @if (count($errors) > 0)
                            <div id="err">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                        {{ Form::open(['url' => 'login', 'method' => 'post']) }}
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" name="username" autocomplete="off" required autofocus>
                                    <label for="username">Username</label>
                                </div>

                                <div class="input-field col s12">
                                    <input type="password" name="password" id="password" required>
                                    <label for="password">Password</label>

                                    <div class="hide-show">
                                        <i class="material-icons show">visibility_off</i>
                                    </div>
                                </div>

                                <div class="col s12 input-field">
                                    <button class="btn waves-effect waves-light blue darken-1 right">Sign in</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/materialize/js/materialize.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.hide-show i.material-icons').click(function() {
                if( $(this).hasClass('show') ) {
                    $(this).text('visibility');
                    $('#password').attr('type', 'text');
                    $(this).removeClass('show');
                } else {
                    $(this).text('visibility_off');
                    $('#password').attr('type', 'password');
                    $(this).addClass('show');
                }
            });
        });
    </script>
</body>
</html>
