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
                    <input type="text" name="phone" class="form-control" id="formphone" placeholder="Phone" required>
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
        $(document).ready(function() {
            $('#formphone').on('input', function() {
                let input = $(this).val();

                input = input.replace(/\D/g, '');

                if (input.length > 3 && input.length <= 6) {
                    input = '(' + input.substring(0, 3) + ') ' + input.substring(3);
                } else if (input.length > 6) {
                    input = '(' + input.substring(0, 3) + ') ' + input.substring(3, 6) + ' ' + input.substring(6, 10);
                }

                $(this).val(input);
            });
        });
        $(document).ready(function() {
            $('#registerForm').submit(function(e) {
                e.preventDefault();

                let password = $('#password').val();
                let confirmPassword = $('#password_confirmation').val();

                if (password !== confirmPassword) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Password Mismatch',
                        text: 'Your password and confirm password must match.',
                        confirmButtonColor: '#6c757d'
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('postRegister') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank you for registering!',
                                text: 'Click "Continue" to proceed to your dashboard.',
                                confirmButtonText: 'Continue',
                                confirmButtonColor: '#6c757d'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Simulate login loading
                                    Swal.fire({
                                        title: 'Logging you in...',
                                        text: 'Please wait a moment.',
                                        icon: 'info',
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        timer: 2000,
                                        didOpen: () => Swal.showLoading()
                                    });

                                    setTimeout(() => {
                                        window.location.href = response.redirect;
                                    }, 2000);
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Registration Failed',
                                text: response.message || 'An unexpected error occurred.',
                                confirmButtonColor: '#6c757d'
                            });
                        }
                    },
                    error: function(xhr) {
                        let message = 'An error occurred. Please check your input.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Error',
                            text: message,
                            confirmButtonColor: '#6c757d'
                        });
                    }
                });
            });
        });

    </script>

</body>

</html>
