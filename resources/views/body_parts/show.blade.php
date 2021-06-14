@extends('layouts.app')

@section('content')
    <a href="/bodyParts" class="btn btn-default">Zpět</a>
    <h1>ID:{{$body_part->id}}</h1>
    <p>Název partie: {{$body_part->name}}</p>
    <hr>
    <small>Vytvořeno: {{$body_part->created_at}}</small>
    <hr>
    <a href="/bodyParts/{{$body_part->id}}/edit" class="btn btn-info">Editovat</a>

    {!! Form::open(['action' => ['App\Http\Controllers\Body_PartController@destroy', $body_part->id, 'method' => 'POST', 'class' => 'pull-right']]) !!}
            
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Smazat', ['class' => 'btn btn-danger mt-2'])}}

    {!! Form::close() !!}
@endsection