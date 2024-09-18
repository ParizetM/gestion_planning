@extends('layouts.app')

@section('content')
<h1>Bienvenue</h1>
<a href="{{ route('absences.index') }}">Voir les absences</a>
@endsection
