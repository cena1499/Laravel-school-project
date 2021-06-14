@extends('layouts.app')

@section('content')
    <h1>Části těla</h1>
    <a class="btn btn-success" href="/bodyParts/create">Vytvořit novou partii</a>

    @if(count($body_parts) > 0)
        <div class="row mt-4">
            @foreach($body_parts as $body_part)

                <div class="col-sm-3">
                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                        <div class="card-body text-dark">
                            <h5 class="card-title"><a class="text-dark" href="/bodyParts/{{$body_part->id}}">{{$body_part->name}}</a></h5>
                            <p class="card-text">
                                <small>Vytvořeno: {{$body_part->created_at}}</small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else

    @endif
@endsection