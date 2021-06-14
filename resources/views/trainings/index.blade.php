@extends('layouts.app')

@section('content')
    
    <h1 class="text-center">Tréninky</h1>
    <!--<a class="btn btn-success" href="/trainings/create">Vytvořit nový trénink</a>!-->

    @if(count($trainings) > 0)
            <div class="row mt-4">
                @foreach($trainings as $training)
                    <div class="col-sm-3">
                        <div class="card border-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">{{$training->name}}</div>
                            <div class="card-body text-dark">
                                <h5 class="card-title"><a class="text-dark" href="/trainings/{{$training->id}}">{{$training->workout_name}}</a></h5>
                                <p class="card-text">
                                    Opakování: {{$training->repetition}}
                                    <br>
                                    Váha: {{$training->weight}}
                                    <br>
                                    <small>Written on {{$training->created_at}}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    @else
        <p>Žádný trénink není k dispozici.</p>
    @endif
@endsection