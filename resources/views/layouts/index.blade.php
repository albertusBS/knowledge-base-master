<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="{{ url('/image/Logo.png') }}">

        <title>Knowledge Base</title>

        {{-- Bootstrap v5.3 --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous">

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

        {{-- CSS Lokal --}}
        <link rel="stylesheet" href="{{ asset('style/style.css') }}"></link>

        {{-- JQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
    </head>

    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand">
                    <img src="{{ url('../image/Logo UAJY.png') }}" width="225" alt="Title Logo">
                </a>
                @auth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#basicExampleNav" aria-controls="basicExampleNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="basciExampleNav">
                    <ul class="navbar-nav mb-lg-10 me-2 mb-1 ms-auto"></ul>
                    <ul class="navbar-nav mb-lg-10 me-2 mb-1"></ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" id="navbarDropdownMenuLink">
                                <strong>{{ auth()->user()->nama_admin }}</strong>
                            </a>
                            <div class="dropdown-menu dropdown-primary"
                                aria-labelledby="navbarDropdownMenuLink">
                                @can('isAdminKSI')
                                <a class="dropdown-item" href="{{ route('dashboardAdmin') }}">
                                    <i class="bi-person-gear"></i> Manage User
                                </a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('dashboardUnit') }}">
                                    <i class="bi-journal-text"></i> Post
                                </a>
                                <a class="dropdown-item" href="{{ route('managePertanyaan')}}">
                                    <i class="bi-chat-left-dots"></i> Pertanyaan
                                </a>
                                <a class="dropdown-item" href="{{ route('indexEditPassword', auth()->user()->id) }}">
                                    <i class="bi-lock"></i> Ganti Password
                                </a>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="bi-box-arrow-left"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </nav>

        <main class="flex-grow-1">
            <div class="container">
                @yield('container')
            </div>
        </main>

        <footer class="fs-5 fw-semibold text-center py-3"
            style="background-color: orange">
            <a class="text-light text-decoration-none" href="www.uajy.ac.id">
                &copy; Universitas Atma Jaya Yogyakarta
            </a>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous" defer>
        </script>

        {{-- Script Embedly untuk menampilkan video embed --}}
        <script>
            document.querySelectorAll( 'oembed[url]' ).forEach( element => {
                // Create the <a href="..." class="embedly-card"></a> element that Embedly uses
                // to discover the media.
                const anchor = document.createElement( 'a' );

                anchor.setAttribute( 'href', element.getAttribute( 'url' ) );
                anchor.className = 'embedly-card';

                element.appendChild( anchor );
            } );
        </script>

        <script>
            $('.dropdown').click( function() {
                $('dropdown-menu').toggleClass('show');
            });
        </script>

        {{-- Toast --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toast = new bootstrap.Toast(document.getElementById('toast'));
                toast.show();
            });
        </script>
    </body>
</html>
