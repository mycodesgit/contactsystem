<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact System</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/js/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.6.2-dist/js/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Logo -->
    <link rel="shortcut icon" type="" href="{{ asset('images/clogo.png') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('index.contact') }}">Contact System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                {{-- <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index.contact') }}">Contact List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('store.contact') }}">Add Contact</a>
                </li> --}}
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <a href="#" class="nav-item btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('body')
    </div>

    <script src="{{ asset('bootstrap-4.6.2-dist/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2-dist/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2-dist/js/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        var fetchContactsRoute = "{{ route('show.contact') }}";
        var contactCreateRoute = "{{ route('create.contact') }}";
        var editContactRoute = "{{ route('edit.contact', ':id') }}";
        // var updateContactRoute = "{{ route('update.contact', ':id') }}";
        var deleteContactRoute = "{{ route('delete.contact', ':id') }}";
    </script>

    @include('script')
</body>

</html>
