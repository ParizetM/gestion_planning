@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mb-4">
            <p class="text-red-500">@error('record') {{$message}} @enderror</p>
        </div>
        <h1 class="text-2xl font-bold mb-4">Motifs</h1>
        <a href="{{route('welcome')}}" class="text-blue-500 hover:underline mb-4 inline-block"><< Retour</a>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($motifs as $motif)
            @if ($motif->deleted_at == null)

                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-xl font-semibold mb-2">
                        <a href="{{ route('motifs.show', $motif->id) }}" class="text-blue-500 hover:underline">Motif n°{{$motif->id}}</a>
                    </h3>
                    <ul class="list-disc pl-5">
                        <li class="mb-1"><strong>Nom:</strong> {{$motif->nom}}</li>
                        <li class="mb-1"><strong>Description:</strong> {{$motif->description}}</li>
                        <li>
                            <a href="{{ route('motifs.show', ['motif' => $motif])}}" class="text-blue-500 hover:underline">Voir plus</a>
                        </li>
                    </ul>
                </div>
                @endif
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{route('motifs.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Créer un motif</a>
        </div>
        <div class="container mx-auto p-4 bg-gray">
            <div class="mb-4">
                <p class="text-red-500">@error('record') {{$message}} @enderror</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($motifs as $motif)
                    @if ($motif->deleted_at != null)
                    <div class="bg-gray-300 shadow-md rounded-lg p-4">
                        <h3 class="text-xl font-semibold mb-2">
                            <a href="{{ route('motifs.show', $motif->id) }}" class="text-blue-500 hover:underline">Motif n°{{$motif->id}}</a>
                        </h3>
                        <ul class="list-disc pl-5">
                            <li class="mb-1"><strong>Nom:</strong> {{$motif->nom}}</li>
                            <li class="mb-1"><strong>Description:</strong> {{$motif->description}}</li>
                            <li>
                                <a href="{{ route('motifs.show', ['motif' => $motif])}}" class="text-blue-500 hover:underline">Voir plus</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                @endforeach
            </div>
    </div>
@endsection
