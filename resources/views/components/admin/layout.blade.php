<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ar" lang="ar" dir="rtl">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/css/bootstrap-select.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminAssets/font/fonts.css') }}">


    <link rel="stylesheet" href="{{ asset('adminAssets/icon/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAssets/css/style2.css') }}">


    {{-- to add a specifice styles --}}
    @stack('styles')


    {{-- jquery cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- sweet Alter cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">


                <x-admin.sidebar />

                <div class="section-content-right ">
                    <x-admin.dashboard-header />

                    <div class="main-content ">
                        <div class="main-content-inner pb-5">



                            {{ $slot }}

                        </div>
                        <x-admin.dashboard-footer />
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="{{ asset('adminAssets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('adminAssets/js/main.js') }}"></script>

    {{-- for delete button (.btn-delete) --}}
    <script type="text/javascript">
        $(".btn-delete").click(function(e) {
            e.preventDefault();
            var form = $(this).parents("form");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    form.submit();
                }
            });
        })
    </script>


    @stack('scripts')

</body>

</html>
