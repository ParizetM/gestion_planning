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
    <header>
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-6 py-3">
                <div class="flex justify-between items-center">
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-800">Home</a>
                    <ul class="flex space-x-4">
                        <li><a href="{{ route('absences.index') }}"
                                class="text-gray-800 hover:text-gray-600">Absences</a></li>
                        <li><a href="{{ route('motifs.index') }}" class="text-gray-800 hover:text-gray-600">Motifs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @if (session()->has('message_erreur'))
            <div class="bg-red-500 text-white p-4 rounded mb-4" id="session_Message">
                {{ session('message_erreur') }}
            </div>
        @endif
        @yield('content')
    </main>
    <footer>
        <div class="container mx-auto p-6">
            <p class="text-center text-gray-500">© Mratin 2024 - Tous droits réservés</p>
        </div>
    </footer>
</body>

</html>
