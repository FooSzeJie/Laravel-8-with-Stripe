@extends('layout')
@section('content')
<div class="row row-cols-1 row-cols-md-3 g-4">
@foreach($products as $product)
  <div class="col">
    <div class="card">
        <input type="hidden" name="id" id="id" value="{{$product->id}}">
        <img src="{{ asset('images/') }}/{{$product->image}}" width="100" class="img-fluid" alt="">
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">{{$product->description}}</p>
            <p class="card-text">{{$product->price}}</p>
            <a href="{{ route('product.detail', ['id' => $product -> id])}}" class="btn btn-warning btn-xs">Edit</a>
      </div>
    </div>
  </div>
  @endforeach
  
</div>
@endsection