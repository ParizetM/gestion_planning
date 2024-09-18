<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

</head>
<body class="bg-gray-100 text-gray-900">
    @yield('content')
</body>
</html>
