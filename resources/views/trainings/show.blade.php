@extends('layouts.app')

@section('content')
    <a href="/trainings" class="btn btn-default">Zpět</a>
    <h1>ID: {{$training->id}}</h1>
    <p>Název cviku: {{$training->workout_name}}</p>
    <p>Název partie: {{$training->name}}</p>
    <p>Popis tréninku: {{$training->description}}</p>
    <p>Počet opakování: {{$training->repetition}}</p>
    <p>Závaží: {{$training->weight}}</p>
    <hr>
    <small>Vytvořeno: {{$training->created_at}}</small>
    <hr>

    @if(!Auth::guest())

        @if(Auth::user()->id == $training->user_id)
        <a href="/trainings/{{$training->id}}/edit" class="btn btn-info">Editovat</a>
            {!! Form::open(['action' => ['App\Http\Controllers\TrainingController@destroy', $training->id, 'method' => 'POST', 'class' => 'pull-right']]) !!}
                    
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Smazat', ['class' => 'btn btn-danger mt-2'])}}
        
            {!! Form::close() !!}
        @endif
        
    @endif
@endsection