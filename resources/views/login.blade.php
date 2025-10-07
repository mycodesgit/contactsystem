<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <!-- Logo -->
    <link rel="shortcut icon" type="" href="{{ asset('images/clogo.png') }}">
</head>

<body class="text-center">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-2">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form id="registerForm" method="post" class="form-signin">
                @csrf

                <img class="mb-4" src="{{ asset('images/clogo.png') }}" alt="C Logo" width="72" height="72">
                <h1 class="h5 mb-3 font-weight-normal">Log in</h1>

                <label for="inputEmail" class="sr-only">Email Address</label>
                <input type="email" id="inputEmail" name="email" class="form-control mb-1" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only mt-3">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <br>
                <button class="btn btn-md btn-secondary btn-block" type="submit">Sign in</button>
                <a class="btn btn-md btn-success btn-block" href="{{ route('getRegister') }}">Register</a>
                <p class="mt-5 mb-3 text-muted">Design by: Joshua Kyle Dalmacio</p>
            </form>
        </div>
    </div>

    <script src="{{ asset('bootstrap-4.6.2-dist/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
