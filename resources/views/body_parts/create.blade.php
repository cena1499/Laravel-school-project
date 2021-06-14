@extends('layouts.app')

@section('content')
    <h1>Vytvořit novou partii</h1>
    
    {!! Form::open(['action' => 'App\Http\Controllers\Body_PartController@store', 'method' => 'POST']) !!} 
    <div class="form-group">
        {{Form::label('name', 'Název')}}
        {{Form::text('name', '',['class' => 'form-control', 'placeholder' => 'Název partie'])}}
    </div>

    {{Form::submit('Vytvořit novou partii', ['class' => 'btn btn-primary mt-2'])}}

    {!! Form::close() !!}
@endsection