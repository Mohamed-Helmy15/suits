@extends('app')

@section('title')

    <title>Types</title>

@endsection

@section('content')

<form action="{{route('types.store')}}" method="post">
@csrf
    <div>
        <label for="type">Type</label>
        <input type="text" name="type" value="{{ old('type') }}">
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
<table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($types as $type)
          
      <tr>
        <th scope="row">{{$type->id}}</th>
        <td colspan="2">{{$type->type}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection