@extends('layouts.app')

@section('content')
    <h1>Vytvořit nový trénink</h1>
    
    {!! Form::open(['action' => 'App\Http\Controllers\TrainingController@store', 'method' => 'POST']) !!} 

    @if(count($workouts) > 0)   
        {{Form::label('workout_id', 'Název cviku')}}
        <select style="width:50%;margin-top: 10px;" name="workout_id">
            
            @foreach($workouts as $workout)
                <option value="{{$workout->id}}">{{$workout->name}} - {{$workout->workout_name}}</option>
            @endforeach
        </select>
    @else
        <p>Bez vytvořených partií nelze vytvořit trénink.</p>
    @endif

    <div class="form-group">
        {{Form::label('description', 'Popis tréninku')}}
        {{Form::textarea('description', '',['class' => 'form-control', 'placeholder' => 'Popis tréninku'])}}       
    </div>

    <div class="form-group">
        {{Form::label('repetition', 'Počet opakování')}}
        {{Form::text('repetition', '',['class' => 'form-control', 'placeholder' => 'Počet opakování'])}}
    </div>

    <div class="form-group">
        {{Form::label('weight', 'Váha')}}
        {{Form::text('weight', '',['class' => 'form-control', 'placeholder' => 'Váha'])}}       
    </div>

    {{Form::submit('Vytvořit nový trénink', ['class' => 'btn btn-primary mt-2'])}}

    {!! Form::close() !!}
@endsection