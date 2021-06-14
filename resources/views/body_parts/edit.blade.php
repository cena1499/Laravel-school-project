@extends('layouts.app')

@section('content')
    <h1>Editace partie</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\Body_PartController@update', $body_part->id], 'method' => 'POST']) !!} 

    <div class="form-group">
        {{Form::label('name', 'Jméno')}}
        {{Form::text('name', $body_part->name, ['class' => 'form-control', 'placeholder' => 'Zadejte jméno'])}}
    </div>

    {{Form::hidden('_method', 'PUT')}}

    {{Form::submit('Upravit partii', ['class' => 'btn btn-primary mt-2'])}}

    {!! Form::close() !!}
@endsection