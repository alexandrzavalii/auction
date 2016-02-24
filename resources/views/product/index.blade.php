@extends('app')

@section('content')

<h1>Product Catalog</h1>


 
 <form action="/products" method="get">
    <label for="query"></label>
    <input type="query" id="query" name="query">
    <input type="submit">
 </form>
 
 @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (count($products) > 0)

@foreach ($products as $product)

<div class="row product">
    <div class="span4">
        <div class="clearfix content-heading">
            <img class="pull-left product-img" src="/imgs/products/{{ $product->sku }}.png"/>
            <h3>
                {!! link_to_route('products.show', $product->name, [$product->id]) !!}
            </h3>
            <p>
                <strong>${{ $product->price }}</strong><br />



                {{ $product->description }}
          </p>
  </div>
</div>
</div>

@endforeach

@else
<p>
  No items found.
</p>
@endif

@endsection