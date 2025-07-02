<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Smile Clinic</title>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('frontendAssets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/services_style.css') }}">
    {{-- Ensure APP_URL in .env is set to https://city-smile-clinic.onrender.com for correct asset URLs --}}


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>

<body>

    {{-- NavBar  --}}
    <x-frontend.navbar />


    <main>
        {{-- Main content slot --}}
        {{ $slot }}
    </main>



    <!-- Footer -->
    <x-frontend.footer />

    <!-- Language Switcher -->
    {{-- <div class="fixed bottom-4 right-4 z-50">
        <button id="languageSwitcher"
            class="bg-indigo-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-indigo-700 transition">
            العربية
        </button>
    </div> --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>


    @stack('scripts')
    <script src="{{ asset('frontendAssets/js/script.js') }}"></script>
    <script src="{{ asset('frontendAssets/js/main.js') }}"></script>



</body>

</html>
