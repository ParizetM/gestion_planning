@extends('layouts.app')

@section('content')
    <h1>Absence</h1>
    <a href="{{route('absences.index')}}"><< retour</a>
    <ul>
        <li>{{$absence->user->nom}} {{$absence->user->prenom}}  </li>
        <li>du {{$absence->date_debut}} au {{$absence->date_fin}} </li>
        <li>Raison : {{$absence->motif->nom}} </li>
    </ul>
@endsection
