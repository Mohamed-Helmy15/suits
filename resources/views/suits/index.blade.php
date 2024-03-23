@extends('app')

@section('title')

    <title>Suits</title>

@endsection

@section('content')

    <div style="display: flex;
    gap: 20px;
    flex-wrap: wrap;
    padding: 20px;">
        @foreach ($suits as $suit)
    <div class="card" style="width: 18rem; background-size: contain">
        <img src={{  asset('http://127.0.0.1:8000/images/'.$suit->image) }} class="card-img-top" alt="..." style="max-height=300px">
        <div class="card-body">
            <h5 class="card-title"> {{$suit->name}} </h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
        
    @endforeach
    </div>
@endsection

    