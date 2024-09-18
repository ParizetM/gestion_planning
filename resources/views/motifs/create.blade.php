@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Créer un motif</h1>
        <a href="{{route('motifs.index')}}" class="text-blue-500 hover:underline mb-4 inline-block"><< retour</a>
        <form action="{{route('motifs.store')}}" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom du motif</label>
                <input type="text" name="nom" id="nom" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_accessible_salarie" id="is_accessible_salarie" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="is_accessible_salarie" class="ml-2 block text-sm font-medium text-gray-700">Accessible salarié</label>
            </div>
            <div>
                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Créer</button>
            </div>
        </form>
    </div>
@endsection
