@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Reasons') }}</h1>
        <a href="{{ route('motifs.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">
            &lt;&lt; {{ __('Back') }}
        </a>
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">
            <h2 class="text-xl font-semibold mb-2">{{ $motif->nom }}</h2>
            <p class="text-gray-700 mb-2">{{ $motif->description }}</p>
            <p class="text-gray-500 mb-2">{{ $motif->created_at }}</p>
            <p class="text-gray-700 mb-4">{{ $motif->is_accessible_salarie == 1 ? 'Oui' : 'Non' }}</p>
            <a href="{{ route('motifs.edit', $motif) }}" class="text-blue-500 hover:underline">{{ __('Edit') }}</a>
        </div>

        @if ($motif->deleted_at == null)
        <form action="{{ route('motifs.destroy', $motif) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">{{ __('Delete') }}</button>
        </form>
        @else
        <form action="{{ route('motifs.restore', $motif) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PATCH')
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{ __('Restore') }}</button>
        </form>
        @endif
    </div>
@endsection
