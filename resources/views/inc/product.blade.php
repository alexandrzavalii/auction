<div class="col-lg-3 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-11 col-xs-offset-1 hero-feature">

        <div class="thumbnail">

            <img src="/imgs/products/{{ $product->sku }}.png" alt="">

          <div class="caption">
            <h3 class="product-name">{!! link_to_route('products.show', $product->name, [$product->id]) !!}</h3>
            <p>

             @if($product->bid)


                	<div class="row">
                    <div class="col-md-12 col-xs-12">
                                <h4><div data-countdown="{{strtotime($product->bid->expiration)}}"></div></h4>
                    </div>

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
                                   <h4 class="text-warning">Reserved:{{$product->bid->reservedPrice}}</h4>
                                   @else
                                  <script
                                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                      data-key="{{env('STRIPE_API_PUBLIC', 'pk_test_GOBypCWqHxenhGDfHClBzJXH')}}"
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
              {{ $product->description }}
            </p>
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
              @if($product->authorId == Auth::user()->id)
                    <div class="btn-group" role="group">
                        <a href="#" @if($product->bid) disabled @endif class="btn btn-warning btn-block  " data-product="{{$product}}" data-toggle="modal" data-target="#storeBid"  >Add Bid</a>
                    </div>
                    <div class="btn-group" role="group">
                          {!! Form::open(array('route' => array('products.destroy', $product->id), 'method' => 'delete')) !!}
                         <button type="submit" class="btn btn-default btn-block" href="{{ URL::route('products.destroy', $product->id) }}" title="Delete Product">
                         Delete
                         </button>
                       {!! Form::close() !!}
                    </div>
                @else
                    <div class="btn-group" role="group">
                      <a href="#" class="btn btn-primary btn-block  " data-product="{{$product}}" data-toggle="modal" data-target="#buy"  >
                        Buy ${{$product->price}}</a>
                    </div>
                    <div class="btn-group" role="group">
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
                            </div>
                  @endif
                </div>
          </div>
        </div>
      </div>
