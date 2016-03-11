@extends('app')

@section('content')

<h1>User Dashboard</h1>
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
<ul>
	<li>
    Hello. {{Auth::user()->name}}
  </li>
  <li>
    <a href="#"  class="btn btn-warning btn-lg  "  data-toggle="modal" data-target="#addCard"  >Add Card</a>

  </li>
</ul>

<div id="addCard" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Buy</h4>
      </div>
       <form method="POST"  action="{{ route('user.saveCard') }}" accept-charset="UTF-8"  id="purchase-form">
        <div class="modal-body">

         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="product_id" value="">
         <div class="form-group">
                 <div class="row">
                     <div class="col-xs-12">
                         <label for="address" class="control-label">address</label>
                     </div>
                     <div class="col-sm-4">
                         <input type="text"
                                class="form-control"
                                id="address"
                                placeholder="Valid Address"
                             >
                     </div>
                 </div>
             </div>
         <div class="form-group">
                 <div class="row">
                     <div class="col-xs-12">
                         <label for="card-number" class="control-label">Credit Card Number</label>
                     </div>
                     <div class="col-sm-4">
                         <input type="text"
                                class="form-control"
                                id="card-number"
                                placeholder="Valid Card Number" required
                                data-stripe="number"
                                value="4242424242424242">
                     </div>
                 </div>
             </div>

             <div class="form-group">
                 <div class="row">
                     <div class="col-xs-4">
                         <label for="card-month">Expiration Date</label>
                     </div>
                     <div class="col-xs-8">
                         <label for="card-cvc">Security Code</label>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-xs-2">
                         <input type="text" size="3"
                                class="form-control"
                                name="exp_month"
                                data-stripe="exp-month"
                                placeholder="MM"
                                id="card-month"
                                value="12"
                                required >
                     </div>
                     <div class="col-xs-2">
                         <input type="text" size="4"
                                class="form-control"
                                name="exp_year"
                                data-stripe="exp-year"
                                placeholder="YYYY"
                                id="card-year"
                                value="2016"
                                required >
                     </div>
                     <div class="col-xs-2">
                         <input type="text"
                                class="form-control"
                                id="card-cvc"
                                placeholder=""
                                size="6"
                                value="111"
                                required >
                     </div>
                 </div>

             </div>
        </div><!-- .modal-body -->

        <div class="modal-footer">
              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                  </div>
                  <div class="btn-group" role="group">
                      <button type="submit" class="submit-button btn btn-primary">Save</button>
                  </div>
              </div>
        </div>
      </form>
    </div>

  </div><!-- /.modal-dialog -->
</div>  <!-- /.modal -->
@endsection
@section('js')
  @include('user.stripejs')
@endsection
