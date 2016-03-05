@extends('app')

@section('content')
  <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +359 879691979</p></div>
                        <a href="#" class="addProduct" data-toggle="modal" data-target="#createProduct"  >Add Product</a>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form" action="/products" method="get">
                                    <input type="text" class="search-form" type="query" id="query" name="query" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->
    </header>
<div class="container">
      @include('createProduct.modal')
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


<hr>
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
