@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-4xl font-extrabold mb-6 text-gray-800">{{ __('Détails de l\'absence') }}</h1>
        <a href="{{ route('absences.index') }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">
            &lt;&lt; {{ __('Retour à la liste') }}
        </a>
        <div class="bg-white p-4 rounded-lg">
            <ul class="list-disc pl-5 space-y-4">
                <li>
                    <span class="font-semibold text-gray-700">{{ __('Nom:') }}</span>
                    <span class="text-gray-900">{{ $absence->user->nom }} {{ $absence->user->prenom }}</span>
                </li>
                <li>
                    <span class="font-semibold text-gray-700">{{ __('Période:') }}</span>
                    <span class="text-gray-900">{{ __('du') }} {{ $absence->date_debut }} {{ __('au') }} {{ $absence->date_fin }}</span>
                </li>
                <li>
                    <span class="font-semibold text-gray-700">{{ __('Raison:') }}</span>
                    <span class="text-gray-900">{{ $absence->motif->nom }}</span>
                </li>
                <li>
                    <a href="{{ route('absences.edit', $absence->id) }}" class="text-blue-600 hover:text-blue-800">
                        {{ __('Modifier') }}
                    </a>
                </li>
            </ul>
        </div>
        <form action="{{ route('absences.destroy', $absence) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">{{ __('Supprimer') }}</button>
        </form>
    </div>
@endsection
