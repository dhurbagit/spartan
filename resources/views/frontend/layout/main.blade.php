<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>{{ $menu->metaTitle ?? '' }}</title>
    <meta name="description" content="{{ $menu->metaDescription ?? '' }}">
    <meta name="keywords" content="{{ $menu->metaKeyword ?? '' }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugin/fontawesome-free-7.0.1-web/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('frontend/plugin/lightGallery-master/dist/css/lightgallery-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/img/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('backend/img/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('backend/img/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('backend/img/favicon_io/site.webmanifest') }}">

</head>

<body>

    @include('frontend.layout.header')

    @yield('content')

    @include('frontend.layout.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    {{-- <script src="{{ asset('frontend/plugin/fontawesome-free-7.0.1-web/js/all.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/plugin/lightGallery-master/dist/lightgallery.umd.js') }}"></script>
    <script src="{{ asset('frontend/plugin/lightGallery-master/dist/plugins/thumbnail/lg-thumbnail.umd.js') }}"></script>
    <script src="{{ asset('frontend/plugin/lightGallery-master/dist/plugins/zoom/lg-zoom.umd.js') }}"></script>
    <script src="{{ asset('frontend/plugin/lightGallery-master/dist/plugins/thumbnail/lg-thumbnail.min.js') }}"></script>
    {!! NoCaptcha::renderJs() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        // toster ja
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    @stack('scripts')

    <script>
        lightGallery(document.getElementById('static-thumbnails'), {
            selector: 'a',
            animateThumb: false,
            zoomFromOrigin: false,
            allowMediaOverlap: true,
            toggleThumb: true,
        });
    </script>



    <script>
        // Get current year
        const currentYear = new Date().getFullYear();

        // Insert into the span
        document.getElementById("year").textContent = currentYear;
    </script>
    <script>
        $('.partnerlogo_carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        })
    </script>
</body>

</html>
