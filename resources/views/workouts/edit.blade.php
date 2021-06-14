@extends('layouts.app')

@section('content')
    <h1>Editovat cvik</h1>
     {!! Form::open(['action' => ['App\Http\Controllers\WorkoutController@update', $workout->id], 'method' => 'POST']) !!} 
    <div class="form-group">
        {{Form::label('workout_name', 'Název cviku')}}
        {{Form::text('workout_name', $workout->workout_name,['class' => 'form-control', 'placeholder' => 'Název cviku'])}}       
    </div>

    @if(count($workout->body_parts) > 0)   
        {{Form::label('body_part_id', 'Název partie')}}
        <select style="width:50%;margin-top: 10px;" name="body_part_id">
            
            <option value="{{$workout->body_part_id}}">{{$workout->name}}</option>
            
            @foreach($workout->body_parts as $body_part)
                @if($body_part->id != $workout->body_part_id)
                    <option value="{{$body_part->id}}">{{$body_part->name}}</option>
                @endif
            @endforeach
        </select>
    @else
        <p>Bez vytvořených partií nelze editovat cvik.</p>
    @endif

    {{Form::hidden('_method', 'PUT')}}

    {{Form::submit('Editovat cvik', ['class' => 'btn btn-primary mt-2'])}}

    {!! Form::close() !!}

@endsection