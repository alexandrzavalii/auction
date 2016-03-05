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
@include('inc.footer')
</div>
@endsection
@section('counterjs')
  <script>

  $('#storeBid').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var product = button.data('product')
    var modal = $(this)
    modal.find('.modal-title').text('Create bid for ' + product["name"])
     modal.find(".modal-body input[name='product_id'] ").val(product["id"])
    modal.find(".modal-body input[name='max'] ").val(product["price"])
  })

  $('#bid').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var product = button.data('product')
    var modal = $(this)
    console.log(product["bid"]["amount"]);
    modal.find('.modal-title').text('Create bid for ' + product["name"]+' is $'+ product["bid"]["amount"])
     modal.find(".modal-body input[name='product_id'] ").val(product["id"])
    modal.find(".modal-body input[name='currentBid'] ").val(product["bid"]["amount"])
  })

           $('[data-countdown]').each(function() {
     var $this = $(this), finalDate = $(this).data('countdown');
               expiration = new Date(finalDate * 1000);

     $this.countdown(expiration, function(event) {
       $this.html(event.strftime('%D days %H:%M:%S'));
     });

   });

   //textarea limit
   $('#characterLeft').text('233 characters left');
$('#message').keyup(function () {
    var max = 233;
    var len = $(this).val().length;
    if (len >= max) {
        $('#characterLeft').text('You have reached the limit');
        $('#characterLeft').addClass('red');
        $('#btnSubmit').addClass('disabled');
    }
    else {
        var ch = max - len;
        $('#characterLeft').text(ch + ' characters left');
        $('#btnSubmit').removeClass('disabled');
        $('#characterLeft').removeClass('red');
    }
});

  </script>

@endsection
