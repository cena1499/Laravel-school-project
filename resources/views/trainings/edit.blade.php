@extends('layouts.app')

@section('content')
    <h1>Editovat trénink</h1>
    
    {!! Form::open(['action' => ['App\Http\Controllers\TrainingController@update', $training->id], 'method' => 'POST']) !!} 

    @if(count($training->workouts) > 0)   
        {{Form::label('workout_id', 'Název cviku')}}
        <select style="width:50%;margin-top: 10px;" name="workout_id">
            
            <option value="{{$training->workout_id}}">{{$training->name}} - {{$training->workout_name}}</option>
            
            @foreach($training->workouts as $workout)
                @if($training->workout_id != $workout->id)
                    <option value="{{$workout->id}}">{{$workout->name}} - {{$workout->workout_name}}</option>
                @endif
            @endforeach
        </select>
    @else
        <p>Bez vytvořených cviků nelze vytvořit trénink.</p>
    @endif

    <div class="form-group">
        {{Form::label('description', 'Popis tréninku')}}
        {{Form::textarea('description', $training->description,['class' => 'form-control', 'placeholder' => 'Popis tréninku'])}}       
    </div>

    <div class="form-group">
        {{Form::label('repetition', 'Počet opakování')}}
        {{Form::text('repetition', $training->repetition,['class' => 'form-control', 'placeholder' => 'Počet opakování'])}}
    </div>

    <div class="form-group">
        {{Form::label('weight', 'Váha')}}
        {{Form::text('weight', $training->weight,['class' => 'form-control', 'placeholder' => 'Váha'])}}       
    </div>

    {{Form::hidden('_method', 'PUT')}}

    {{Form::submit('Editovat trénink', ['class' => 'btn btn-primary mt-2'])}}

    {!! Form::close() !!}
@endsection