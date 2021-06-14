@extends('layouts.app')

@section('content')       
    <h1 class="text-center">Vítejte na fitness stránce pro uchovávání tréninků</h1>
    @if(Auth::guest())
        <h5 class="text-center text-danger">Pro plnou funkcionalitu webové aplikace se prosím přihlaste.</h5>
    @endif
@endsection