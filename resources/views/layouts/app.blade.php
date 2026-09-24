<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Real Estate Management System')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <main>
        @yield('content')
    </main>

</body>

</html>