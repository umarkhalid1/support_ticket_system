<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard | Support Ticketing System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content="A fully featured admin theme which can be used to build CRM, CMS, etc., Tailwind, TailwindCSS, Tailwind CSS 3"
        name="description">
    <meta content="coderthemes" name="author">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- plugin css -->
    {{-- <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css"> --}}

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    @livewireStyles

    <style>
        .toast-success {
            background-color: #0A8D6E !important;
            color: #fff !important;
            opacity: 1 !important;
        }

        .toast-error {
            color: #fff !important;
            opacity: 1 !important;
        }

        .toast-success .toast-progress {
            background-color: #c3e6cb !important;
        }

        .select2-container .select2-selection--single {
            height: 37px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 33px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 33px;
        }


        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black !important;
        }

        .select2-selection--multiple {
            height: 40px;
        }

        .loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 56px;
            height: 56px;
            display: grid;
            color: #212529;
            background: radial-gradient(farthest-side, currentColor calc(100% - 7px), #0000 calc(100% - 6px) 0);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 15px), #000 calc(100% - 13px));
            border-radius: 50%;
            animation: spinner-sm4bhi 2s infinite linear;
        }

        .spinner::before,
        .spinner::after {
            content: "";
            grid-area: 1/1;
            background: linear-gradient(currentColor 0 0) center,
                linear-gradient(currentColor 0 0) center;
            background-size: 100% 11px, 11px 100%;
            background-repeat: no-repeat;
        }

        .spinner::after {
            transform: rotate(45deg);
        }

        @keyframes spinner-sm4bhi {
            100% {
                transform: rotate(1turn);
            }
        }
    </style>

</head>

<body>

    <div class="flex wrapper">

        <!-- Sidenav Menu -->
        <div class="app-menu">
            @include('layouts.admin.partials.sidebar')
        </div>
        <!-- Sidenav Menu End  -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- Topbar Start -->
            <header class="app-header flex items-center px-4 gap-3.5">
                <div id="loading-spinner" class="loading-spinner">
                    <div class="spinner"></div>
                </div>

                @include('layouts.admin.partials.header')
            </header>
            <!-- Topbar End -->

            <main class="p-6">

                {{ $slot }}

            </main>

            <!-- Footer Start -->
            <footer class="footer h-16 flex items-center px-6 bg-white shadow dark:bg-gray-800 mt-auto">
                @include('layouts.admin.partials.footer')
            </footer>
            <!-- Footer End -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>

    <!-- Plugin Js -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/lucide/umd/lucide.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40frostui/tailwindcss/frostui.js') }}"></script>

    <!-- App Js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Apex Charts js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector Map Js -->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/jsvectormap/maps/world.js') }}"></script> --}}

    <!-- Dashboard App js -->
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        window.onload = function() {
            $('.select2').select2();
            $('#loading-spinner').fadeOut('slow');
        };
    </script>
    {{-- <script>
        document.addEventListener('livewire:navigated', () => {
            // Only run this code when navigation completes
            if (!window.map) {
                window.map = initializeMap();
            }
        });
    </script> --}}
    @livewireScripts
    @if (session()->has('toastr'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: "5000",
                    preventDuplicates: true,
                };
                toastr["{{ session('toastr.type') }}"]("{!! addslashes(session('toastr.message')) !!}");
            });
        </script>
    @endif
    <script>
        document.addEventListener('livewire:init', () => {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            Livewire.on('notify', (event) => {
                const toastFunction = toastr[event.type] || toastr.info;
                toastFunction(event.message);
            });
        });
    </script>

</body>

</html>
