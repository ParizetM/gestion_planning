@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">{{ __('Welcome') }}</h1>
        <div class="flex space-x-4">
            <a href="{{ route('absences.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('View absences') }}</a>
            <a href="{{ route('motifs.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('View reasons') }}</a>
        </div>
    </div>
@endsection
