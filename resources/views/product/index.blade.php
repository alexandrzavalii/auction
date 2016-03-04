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

  <div class="row text-center">
    @if (count($products) > 0)

      @foreach ($products as $product)

<div class="col-md-4 col-sm-6 hero-feature">
       @if($product->authorId == Auth::user()->id)
             <div class="row">
             <div class="col-md-6 col-sm-6 col-xs-6">
              <a href="#" @if($product->bid) disabled @endif class="btn btn-warning btn-block  " data-product="{{$product}}" data-toggle="modal" data-target="#storeBid"  >Add Bid</a>
                 </div>
                 <div class="col-md-6 col-sm-6 col-xs-6">
               {!! Form::open(array('route' => array('products.destroy', $product->id), 'method' => 'delete')) !!}
              <button type="submit" class="btn btn-danger btn-block" href="{{ URL::route('products.destroy', $product->id) }}" title="Delete Product">
              Delete
              </button>
            {!! Form::close() !!}
                 </div>
               </div>
          @endif
        <div class="thumbnail">
            <img src="/imgs/products/{{ $product->sku }}.png" alt="">

          <div class="caption">
            <h3 class="product-name">{!! link_to_route('products.show', $product->name, [$product->id]) !!}</h3>
            <p>

             @if($product->bid)


               @if(strtotime($product->bid->expiration)-strtotime(Carbon\Carbon::now())<0)
                  @if( $product->bid->delete())
                   <h4>Auction Expired</h4>
                   @endif
                @else
                	<div class="row">
                                <h4><div data-countdown="{{strtotime($product->bid->expiration)}}"></div></h4>
						</div>

               {!! Form::open(array('route' => array('products.bid', $product->id), 'id'=>'createBid', 'class' => 'form', 'novalidate' => 'novalidate')) !!}
                {!! Form::hidden('timeLeft', date("H:i:s",strtotime($product->bid->expiration)-strtotime(Carbon\Carbon::now()))) !!}
                <div class="row">
							<div class="col-md-4 col-xs-4">
							   <h4>  {!! Form::label('$'. $product->bid->amount) !!}</h4>
							</div>
							<div class="col-md-8 col-xs-8">
                                   @if(Auth::user()->id ==$product->bid->user_id)
                                   <h4 class="text-success">You are winning!</h4>
                                   @elseif($product->authorId == Auth::user()->id)
                                   <h4 class="text-warning">This is your bid!</h4>
                                   @else
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{env('STRIPE_API_PUBLIC')}}"
                        data-name="SuperAuction.com"
                        data-locale="auto"
                        data-billing-address=true
                        data-shipping-address=true
                        data-allow-remember-me=true
                        data-label="Bid $10"
                        data-description="{{ $product->name }}"
                        data-amount="{{ $product->bid->priceToCents()+1000 }}">
                      </script>

                                   @endif

							</div>
						</div>
            {!! Form::close() !!}
            <br>
            @endif

             @endif

              {{ $product->description }}
            </p>
               <p>
                {!! Form::open(array('url' => '/checkout')) !!}
                    {!! Form::hidden('product_id', $product->id) !!}

                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{env('STRIPE_API_PUBLIC','sk_test_Z98H9hmuZWjFWfbkPFvrJMgk')}}"
                        data-name="SuperAuction.com"
                        data-locale="auto"
                        data-billing-address=true
                        data-shipping-address=true
                        data-allow-remember-me=true
                        data-label="Buy ${{ $product->price }}"
                        data-description="{{ $product->name }}"
                        data-amount="{{ $product->priceToCents() }}">
                      </script>
                    {!! Form::close() !!}


                </p>

                 <p>

                            {!! Form::open(['url' => '/cart/store']) !!}

                        <input
                          type="hidden"
                          name="product_id"
                          value="{{ $product->id }}"/>
                        <button
                          type="submit"
                          class="btn btn-default">Add to Cart
                        </button>
                        {!! Form::close() !!}
                </p>

          </div>

        </div>
      </div>
      @endforeach

    @else
      <div class="nothing col-sm-3">
        <p>
          No items found.
        </p>
      </div>
    @endif
  </div>

</div>


@endsection

@section('counterjs')
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
