@extends('app')

@section('content')
  @include('inc.header')


<div class="container">
      @include('createProduct.modal')


  @if (count($errors) > 0)
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
  @endif
  @if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

  <div class="row auto-clear">

    @if (count($products) > 0)

      @foreach ($products as $product)
          @include('inc.product', array('product'=>$product))
      @endforeach


    @else
      <div class="nothing col-sm-3">
        <p>
          <h1>No items found.</h1>
        </p>
      </div>
    @endif
  </div>

</div>
@include('inc.footer')
@endsection


@section('js')
   @include('partialsjs.counterjs')
   @include('product.productsjs')
@endsection
