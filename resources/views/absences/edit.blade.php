@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <a href="{{ route('absences.index') }}" class="text-blue-500 hover:text-blue-700">&lt;&lt; retour</a>
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Modifier une absence</h1>
    <form action="{{ route('absences.update', $absence) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="motif_id" class="block text-lg font-medium text-gray-700">Motif</label>
            <select name="motif_id" id="motif_id" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg">
                @foreach($motifs as $motif)
                    <option value="{{ $motif->id }}" {{ $motif->id == $absence->motif_id ? 'selected' : '' }}>{{ $motif->nom }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="user_id" class="block text-lg font-medium text-gray-700">Utilisateur</label>
            <select name="user_id" id="user_id" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $absence->user_id ? 'selected' : '' }}>{{ $user->nom }} {{ $user->prenom }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="date_debut" class="block text-lg font-medium text-gray-700">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" value="{{ $absence->date_debut }}" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg">
        </div>
        <div>
            <label for="date_fin" class="block text-lg font-medium text-gray-700">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" value="{{ $absence->date_fin }}" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg">
        </div>
        <div>
            <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Modifier
            </button>
        </div>
    </form>
</div>
@endsection
