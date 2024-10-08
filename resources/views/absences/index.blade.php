@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-6xl font-extrabold text-gray-800 mb-8">{{ __('Absences') }}</h1>
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">
            &larr; {{ __('Retour') }}
        </a>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($absences as $absence)
            @if ($absence->deleted_at == null)
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6">
                    <h3 class="text-2xl font-semibold text-gray-700 mb-4">
                        <a href="{{ route('absences.show', $absence->id) }}" class="text-blue-600 hover:text-blue-800">
                            {{ __('Absence n°') }}{{ $absence->id }}
                        </a>
                    </h3>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li class="mb-2"><strong>{{ __('Nom') }} :</strong> {{ $absence->user->nom }} {{ $absence->user->prenom }}</li>
                        <li class="mb-2"><strong>{{ __('Période') }} :</strong> {{ __('du') }} {{ $absence->date_debut }} {{ __('au') }} {{ $absence->date_fin }}</li>
                        <li class="mb-2"><strong>{{ __('Raison') }} :</strong> {{ $absence->motif->nom }}</li>
                    </ul>
                </div>
                @endif
            @endforeach
            <div class="mt-4">
                <a href="{{route('absences.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('Créer une absence') }}</a>
            </div>
            <br/>
            <br/>
            <br/>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($absences as $absence)
            @if ($absence->deleted_at != null)
                <div class="bg-gray-300 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6">
                    <h3 class="text-2xl font-semibold text-gray-700 mb-4">
                        <a href="{{ route('absences.show', $absence->id) }}" class="text-blue-600 hover:text-blue-800">
                            {{ __('Absence n°') }}{{ $absence->id }}
                        </a>
                    </h3>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li class="mb-2"><strong>{{ __('Nom') }} :</strong> {{ $absence->user->nom }} {{ $absence->user->prenom }}</li>
                        <li class="mb-2"><strong>{{ __('Période') }} :</strong> {{ __('du') }} {{ $absence->date_debut }} {{ __('au') }} {{ $absence->date_fin }}</li>
                        <li class="mb-2"><strong>{{ __('Raison') }} :</strong> {{ $absence->motif->nom }}</li>
                    </ul>
                </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection
