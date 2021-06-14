@extends('layouts.app')

@section('content')
    <h1>Vytvořit nový cvik</h1>
    
    {!! Form::open(['action' => 'App\Http\Controllers\WorkoutController@store', 'method' => 'POST']) !!} 
    <div class="form-group">
        {{Form::label('workout_name', 'Název cviku')}}
        {{Form::text('workout_name', '',['class' => 'form-control', 'placeholder' => 'Název cviku'])}}       
    </div>

    @if(count($body_parts) > 0)   
        {{Form::label('body_part_id', 'Název partie')}}
        <select style="width:50%;margin-top: 10px;" name="body_part_id">
            
            @foreach($body_parts as $body_part)
                <option value="{{$body_part->id}}">{{$body_part->name}}</option>
            @endforeach
        </select>
    @else
        <p>Bez vytvořených partií nelze vytvořit cvik.</p>
    @endif

    {{Form::submit('Vytvořit nový cvik', ['class' => 'btn btn-primary mt-2'])}}

    {!! Form::close() !!}
@endsection