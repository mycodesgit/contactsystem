<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/js/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/js/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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
            <form id="registerForm" action="{{ route('postRegister') }}" method="POST" class="form-signin">
                @csrf

                <img class="mb-4" src="{{ asset('images/clogo.png') }}" alt="C Logo" width="72" height="72">
                <h1 class="h5 mb-3 font-weight-normal">Register</h1>

                <div class="form-group mb-2">
                    <label class="sr-only">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="form-group mb-2">
                    <label class="sr-only">Company</label>
                    <input type="text" name="company" class="form-control" placeholder="Company" required>
                </div>
                <div class="form-group mb-2">
                    <label class="sr-only">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone (e.g. (723) 123 4567)" required>
                </div>
                <div class="form-group mb-2">
                    <label class="sr-only">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email address" required>
                </div>
                <div class="form-group mb-2">
                    <label class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <label class="sr-only">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button class="btn btn-md btn-secondary btn-block" type="submit">Register</button>
                <p class="mt-3 mb-0 text-muted">Already have an account? <a href="{{ route('getLogin') }}">Login</a></p>
                <p class="mt-4 mb-3 text-muted">Design by: Joshua Kyle Dalmacio</p>
            </form>

        </div>
    </div>

    <script src="{{ asset('bootstrap-4.6.2-dist/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2-dist/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2-dist/js/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.form-signin');
            const password = document.getElementById('inputPassword');
            const confirmPassword = document.getElementById('inputConfirmPassword');

            form.addEventListener('submit', function (e) {
                e.preventDefault(); 

                if (password.value !== confirmPassword.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Mismatch',
                        text: 'Your password and confirm password must be the same.',
                        confirmButtonColor: '#6c757d',
                    });
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Thank you for registering!',
                    text: 'Click continue to proceed to your dashboard.',
                    confirmButtonText: 'Continue',
                    confirmButtonColor: '#6c757d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/dashboard'; 
                    }
                });
            });
        });

        // Register form
        $('#registerForm').submit(function(e) {
            e.preventDefault();

            let password = $('#password').val();
            let confirmPassword = $('#password_confirmation').val();

            // Front-end password match check
            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Password Mismatch',
                    text: 'Your password and confirm password must match.',
                    confirmButtonColor: '#6c757d'
                });
                return;
            }

            // Success SweetAlert (confirmation)
            Swal.fire({
                icon: 'success',
                title: 'Thank you for registering!',
                text: 'Click "Continue" to automatically log in.',
                confirmButtonText: 'Continue',
                confirmButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show auto login simulation
                    Swal.fire({
                        title: 'Logging you in...',
                        text: 'Please wait a moment.',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Simulate auto-login redirect (after short delay)
                    setTimeout(() => {
                        window.location.href = '/dashboard'; // change to your dashboard route
                    }, 2000);
                }
            });
        });

    </script>

</body>

</html>
