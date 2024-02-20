<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">

    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('owlCarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owlCarousel/css/owl.theme.default.min.css') }}">

    {{-- Ex zoom product image --}}
    <link rel="stylesheet" href="{{ asset('xzoom/src/jquery.exzoom.css') }}">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <style>
        .nav-item {
            margin: 0 10px;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .btn_product:hover {
            background-color: #009CFF;
            color: white;
            border-color: transparent;
        }
    </style>
</head>

<body>
    <div id="app" class="bg-white">
        @include('layouts.include.frontend.navbar')
        {{-- @include('sweetalert::alert') --}}

        <main style="padding: 100px 0">
            @yield('content')
        </main>

        @include('layouts.include.frontend.footer')
    </div>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- EX zoom --}}
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/xzoom/src/jquery.exzoom.js') }}"></script>

    {{-- Owl Carousel --}}
    {{-- <script src="jquery.min.js"></script> --}}
    <script src="{{ asset('owlCarousel/owl.carousel.min.js') }}"></script>
    {{-- 
    <script src="{{ asset('template/js/custom.js') }}"></script> --}}

    @stack('scripts')
    @stack('script')
</body>

</html>
