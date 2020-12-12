<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'POS') }}</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap.min.css')}}"  id="bootstrap-css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assets/backend/css/login.css')}}">

</head>
<body>

<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <h2>Point Of Sale</h2>
            <span class="logo_title mt-5"> Login Dashboard </span>
            <!--            <h1>--><?php //echo $message?><!--</h1>-->
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="admin@gmail.com" placeholder="Email" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="admin1234" placeholder="Password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Login" class="btn btn-outline-danger float-right login_btn">
                </div>

            </form>
        </div>
    </div>
</div>

<script src="{{asset('assets/backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.min.js')}}"></script>
</body>
</html>
