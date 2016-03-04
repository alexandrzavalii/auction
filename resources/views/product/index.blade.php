@extends('app')

@section('content')
<div class="container">
      @include('createProduct.modal')
       <div class="row">
            <div class="col-lg-12">
                <h3>Product Catalog</h3>
            </div>
        </div>
  <div class="row">
    <div class="col-md-9 col-xs-9 col-sm-9">
      <form class="search form-inline" action="/products" method="get">
        <div class="form-group">
          <label for="query"></label>
            <input class="form-control " type="query" id="query" name="query">
            <input class="form-control button" type="submit" value="Search">
        </div>
      </form>

    </div>
     <div class="col-md-3 col-sm-3 col-xs-3">
        <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#createProduct"  >Add Product</a>
        </div>

  </div>
<hr>

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
@endsection
@@section('counterjs')
  <script>

  $('#storeBid').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var product = button.data('product') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Create bid for ' + product["name"])
     modal.find(".modal-body input[name='product_id'] ").val(product["id"])
    modal.find(".modal-body input[name='max'] ").val(product["price"])
  })


           $('[data-countdown]').each(function() {
     var $this = $(this), finalDate = $(this).data('countdown');
               expiration = new Date(finalDate * 1000);

     $this.countdown(expiration, function(event) {
       $this.html(event.strftime('%D days %H:%M:%S'));
     });

   });
  </script>

@endsection
