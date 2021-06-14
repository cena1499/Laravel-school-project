@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Moje tréninky</h3>
                    <a class="btn btn-success" href="/trainings/create">Vytvořit nový trénink</a>
                    
                    @if(count($trainings) > 0)
                        <table class="table table-striped mt-2">
                            <tr>
                                <th>Cvik</th>
                                <th>Partie</th>
                                <th>Opakování</th>
                                <th>Váha</th>
                                <th></th>
                            </tr>
                            @foreach ($trainings as $training)
                                <tr>
                                    <th><a href="/trainings/{{$training->id}}">{{$training->workout_name}}</a></th>
                                    <th>{{$training->name}}</th>
                                    <th>{{$training->repetition}}</th>
                                    <th>{{$training->weight}}</th>
                                    <th>
                                        <a href="/trainings/{{$training->id}}/edit" classs="btn btn-success">Upravit</a>
                                    </th>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Nemáš vytvořené žádné tréninky</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
