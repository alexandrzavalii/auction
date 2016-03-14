@extends('app')

@section('content')

<div class="container">
   @if (count($cart) == 0)
        <h1 class="text-center">cart is currently empty</h1>
    @else
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <table class="table" id="checkout">
                <thead>
                    <tr>
                        <th class="text-center">Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                  {{-- */$total=0;/* --}}
                    @foreach ($cart as $item)
                    <tr>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="/imgs/products/{{ $item->product->sku }}.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#">{{ $item->product->name }}</a></h4>
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div>
                       </td>

                        <td class="col-sm-1 col-md-1" style="text-align: center">
                              <input  class="form-control" id="exampleInputEmail1" value="{{$item->qty }}">
                        </td>

                        <td class="col-sm-1 col-md-1 text-center"><strong>${{ $item->product->price }}</strong></td>

                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->qty * $item->product->price}}</strong></td>

                        <td class="col-sm-1 col-md-1">
                            <a class="btn btn-danger" href="/cart/remove/{{ $item->id }}">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </a>
                        </td>

                    </tr>
                    {{-- */$total=$total+$item->qty * $item->product->price;/* --}}
                    @endforeach

                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>${{$total}}</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>$6.94</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>${{$total=$total+6.94}}</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <a class="btn btn-default" href="/products">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </a></td>
                        <td>
                              <a class="btn btn-warning btn-lg" href="cart/buy">
                               Buy
                             </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
   @if (count($bids) != 0)
        <h1 class="text-left">winning bids: </h1>
        <div class="row">
        <div class="col-sm-12 col-md-12">
            <table class="table" id="checkout">
                <thead>
                    <tr>
                        <th class="text-center">Product</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Expiration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bids as $bid)
                      <tr>
                        <td class="col-sm-6 col-md-6" style="text-align: center">
                          <div class="media">
                              <a class="thumbnail pull-left" href="#"> <img class="media-object" src="/imgs/products/{{ $bid->product->sku }}.png" style="width: 72px; height: 72px;"> </a>
                              <div class="media-body">
                                  <h4 class="media-heading"><a href="#">{{ $bid->product->name }}</a></h4>
                                  <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                              </div>
                          </div>
                       </td>
                        <td class="col-sm-3 col-md-3 text-center"><strong>${{ $bid->amount }}</strong></td>
                        <td class="col-sm-3 col-md-3 text-center"><div data-bid="{{$bid}}" data-countdown="{{strtotime($bid->expiration)}}"></div></td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
@section('js')
   @include('partialsjs.counterjs')
@endsection
