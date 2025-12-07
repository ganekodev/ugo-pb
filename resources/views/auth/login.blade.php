<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('/images/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/vendor/sweetalert/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{asset('/vendor/mdb/css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('/vendor/mdb/css/mdb.dark.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <script src="{{ asset('/vendor/sweetalert/sweetalert2.min.js') }}"></script>

    <style>
        :root  {
            --gradient: linear-gradient(102.4deg, #c1c0c2 5%, #fcfcfa 100%);
        }
        html,
        body {
            height: 100%;
            font-family: 'Roboto';
        }
        body {
            display: flex;
            align-items: center;
            background-size: 100%;
            background-position: center;
            background-color: whitesmoke;
            background-image: var(--gradient);
            background-size: 200%;
        }
        #login_area {
            display: flex;
            align-items: center;
            background: url("{{ asset('/images/login/pramod-tiwari--YapdmUwuEk-unsplash.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: rgba(9, 20, 45, 0.5);
        }
        #company_area {
            background: url("{{ asset('/images/login/brandi-redd-aJTiW00qqtI-unsplash.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        input:-webkit-autofill,
        input:-webkit-autofill:focus {
            transition: background-color 0s 600000s, color 0s 600000s !important;
        }
    </style>
</head>
<body>
    <div class="row w-100 h-100 m-0" id="login_container">
        <div class="col-3" id="login_area">
            <form method="POST" action="{{ route('login') }}" class="w-100 px-3">
                @csrf
                <div class="form-outline form-white input-group">
                    <input type="email" class="form-control text-light" id="email" name="email"  required autocomplete="off" autofocus>
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                </div>
                <div class="form-outline form-white input-group mt-3">
                    <input id="password" type="password" class="form-control" id="password" name="password" required autocomplete="off">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                </div>
                @if(Session::has('errors'))
                    <div class="text-danger alert d-flex justify-content-between p-0 my-1">
                        <span style="font-size: 0.7rem">{{ $errors->first('email') .$errors->first('active') }}</span>
                        <button type="button" class="btn-close p-0 m-0 mt-1" data-mdb-dismiss="alert" aria-label="Close" style="font-size: 0.6rem;"></button>
                    </div>
                @endif
                @if (Session::has('loginFailed'))
                <div class="text-danger">
                    <span style="font-size: 0.8rem">{{ Session('loginFailed') }}</span>
                </div>
                @endif
                <div class="row mb-0">
                    <div class="">
                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-9" id="company_area"></div>
    </div>
    @if (Session::has('password-changed'))
    <script>
        Swal.fire({
            width               : '30em',
            icon                : 'success',
            text                : "{{ session('password-changed') }}",
            timer               : 5000,
            showConfirmButton   : false,
            showClass   : {
                popup   : 'toast-animation-show animate__fadeInRight',
            },
            hideClass   : {
                popup   : 'toast-animation-hide animate__fadeOutRight',
            },
            toast       : true,
            position    : 'top-end',
            timerProgressBar    : true,
            showCloseButton     : true,
        });
    </script>
    @endif
    <script src="{{asset('/vendor/mdb/js/mdb.min.js')}}"></script>
</body>
