<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('messages.system_name') }}">
    <meta name="keywords" content="{{ __('messages.system_name') }}">
    <meta name="author" content="MALB1993">
    <title>@yield('title', 'Real Estate Management System')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
    @include('partials.navbar')
    <main class="container">
        @yield('content')
    </main>
    @include('partials.footer')
</body>

</html>