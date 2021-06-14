@extends('layouts.app')

@section('content')
    <a href="/workouts" class="btn btn-default">Zpět</a>
    <h1>ID: {{$workout->id}}</h1>
    <p>Název cviku: {{$workout->workout_name}}</p>
    <p>Název partie: {{$workout->name}}</p>
    <hr>
    <small>Vytvořeno: {{$workout->created_at}}</small>
    <hr>

    <a href="/workouts/{{$workout->id}}/edit" class="btn btn-info">Editovat</a>

    {!! Form::open(['action' => ['App\Http\Controllers\WorkoutController@destroy', $workout->id, 'method' => 'POST', 'class' => 'pull-right']]) !!}
            
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Smazat', ['class' => 'btn btn-danger mt-2'])}}

    {!! Form::close() !!}
@endsection