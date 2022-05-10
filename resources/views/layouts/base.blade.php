<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.ico') }}">

    <meta name="description" content="Tu cherches un stage pour valider ton année ? Vous désirez engager un stagiare ? Alors vous eêtes au bon endroit !">
    <!--google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!--import du style personnalisé-->
    <link rel="preload" href="{{ asset('assets/style/css/root.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets/style/css/root.css') }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--import cdn tailwind components-->
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css" />

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!--tinymce-->
    <!--
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#candidature',
            mobile: {
                menubar: true
            }
        });
    </script>
    -->
    <!--tinymce/-->



    <style>
        html {
            scroll-behavior: smooth;
        }

        html a {
            text-decoration: none !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

</head>
<body class="font-sans antialiased">
<x-jet-banner />

<div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    <!--notifications-->
    <livewire:flash />

    <!-- Page Content -->
    <main class="my-20">

        <div class="container-fluid mx-auto px-3">

            @yield('content')


        </div>
    </main>
</div>

@include('layouts.footer')

@stack('modals')

@livewireScripts

<!--font awesome-->
<script src="https://kit.fontawesome.com/11070bdd9d.js" crossorigin="anonymous"></script>

<!--alpine js-->
<script src="//unpkg.com/alpinejs" defer></script>

<!--bootstrap js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



</body>
</html>
