@extends('layouts.app')

@section('content')
    <h1>Absences</h1>
        @foreach ($absences as $absence)
        <h3><a href="{{ route('absences.show',$absence->id) }}">Absence n°{{$absence->id}}</a> </h3>
    <ul>
        <li>{{$absence->user->nom}} {{$absence->user->prenom}}  </li>
        <li>du {{$absence->date_debut}} au {{$absence->date_fin}} </li>
        <li>Raison : {{$absence->motif->nom}} </li>
    </ul>
    @endforeach

@endsection
