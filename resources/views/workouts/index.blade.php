@extends('layouts.app')

@section('content')
    <h1>Cviky</h1>
    <a class="btn btn-success" href="/workouts/create">Vytvořit nový cvik</a>

    @if(count($workouts) > 0)
        <div class="row mt-4">
            @foreach($workouts as $workout)
                <div class="col-sm-3">
                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                        <div class="card-body text-dark">
                            <h5 class="card-title"><a class="text-dark" href="/workouts/{{$workout->id}}">{{$workout->workout_name}}</a></h5>
                            <p class="card-text">
                                Partie: {{$workout->name}}
                                <br>
                                <small>Written on {{$workout->created_at}}</small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else

    @endif
@endsection