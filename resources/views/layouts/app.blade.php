<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Y-Archive</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/materialize/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/DataTables/css/dataTables.material.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-material.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('style')

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/material%20icon/icon-material.css') }}">
</head>
<body>
    <div id="app">
    
        @if (count($errors) > 0)
            <div id="error" style="display: none;">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
            <script>
                $(document).ready(function() {
                    var err = {{ count($errors) > 0 ? 'true' : 'false' }};
                    if (err) {
                        swal({
                          title : 'Opps...',
                          type  : 'error',
                          html  : jQuery('#error').html(),
                          timer : 5000,
                        });
                    }
                });
            </script>
        @endif

        <div class="navbar-fixed">
            <nav class="nav-wrapper cyan">

                <!-- Branding Image -->
                <a href="#" class="brand-logo">Archive</a>

                <!-- Collapsed Hamburger -->
                <a href="#" data-activates="slide-out" class="button-collapse">
                    <i class="material-icons">menu</i>
                </a>
            </nav>
        </div>

        <div class="row">
            <div class="col s12 m12 l2">
                <ul id="slide-out" class="side-nav fixed">
                    <li class="user-detail sidebar" style="background: url('{{ asset('img/background.jpg') }}') no-repeat;">
                        <div class="row" style="margin-bottom: 0;">
                            <div class="col s4 m4 l4" style="position: relative; top: 10px; left: 10px;">
                                <img src="{{ asset('img/default.jpg') }}" class="circle responsive-img user-detail">
                            </div>
                            <div class="col s8 m8 l8">
                                <a href="#" data-activates="dropdown" class="user profile-name dropdown-button">
                                    {{ Auth::user()->name }}
                                    <i class="material-icons" style="position: relative; top:10px;">
                                        keyboard_arrow_down
                                    </i>
                                </a>
                                <ul id="dropdown" class="dropdown-content">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="{{ url('logout') }}">
                                            {{-- onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" --}}
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                                <p class="user">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </li>
                @if (Auth::user()->role_id == 1) {{-- SA --}}
                    <li><a class="waves-effect" href="{{ url('/') }}">Home</a></li>
                    <li><a class="waves-effect" href="{{ url('user') }}">User</a></li>
                    {{-- <li><a class="waves-effect" href="{{ url('division') }}">Division</a></li> --}}
                @elseif (Auth::user()->role_id == 2) {{-- Seketaris --}}
                    <li><a class="waves-effect" href="{{ url('arsip-surat') }}">Letter</a></li>
                    <li><a class="waves-effect" href="{{ url('laporan') }}">Report</a></li>
                @elseif (Auth::user()->role_id > 2) {{-- Division --}}
                    <li>
                        <a class="waves-effect" href="{{ url('inbox') }}">
                            Inbox <span id="notif"></span>
                        </a>
                    </li>
                @endif
                </ul>
            </div>
            <div class="col s12 m12 l10">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/materialize/js/materialize.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/js/dataTables.material.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2-material.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('script')
    @if (Auth::user()->role_id > 2)
        <script>
            setInterval(function() {
                $.ajax({
                    url: '{{ url('count.unread') }}',
                    type: 'get',
                    success: function(data) {
                        $('#notif').addClass('new badge cyan');
                        $('#notif').html(data);
                        if (data == 0) {
                            $('#notif').removeClass('new badge cyan');
                            $('#notif').html('');
                        }
                    }
                });
            }, 250);
        </script>
    @endif
</body>
</html>
