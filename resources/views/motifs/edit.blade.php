@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <a href="{{ route('motifs.show', $motif) }}" class="text-blue-500 hover:text-blue-700">&lt;&lt; retour</a>
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Modifier un motif</h1>
    <form action="{{ route('motifs.update', $motif) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="nom" class="block text-lg font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom',$motif->nom) }}" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg">
            @error('nom')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description',$motif->description) }}" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg">
            @error('description')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input type="checkbox" name="is_accessible_salarie" id="is_accessible_salarie" {{ old('is_accessible_salarie', $motif->is_accessible_salarie) ? 'checked' : '' }}
                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            </div>
            <div class="ml-3 text-lg">
                <label for="is_accessible_salarie" class="font-medium text-gray-700">Accessible aux salariés</label>
            </div>
            @error('is_accessible_salarie')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Modifier
            </button>
        </div>
    </form>
</div>
@endsection
