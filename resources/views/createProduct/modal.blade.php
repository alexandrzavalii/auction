
  <!-- Create Product  Modal dialog -->
  <div id="createProduct" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Product</h4>
        </div>
          {!! Form::open(array('route' => 'products.store', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}

          <div class="modal-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
                {!! Form::text('name', null, array('required', 'class'=>'form-control', 'placeholder'=>'Product Name')) !!}
         </div>

            <div class="form-group">
                {!! Form::text('sku', null, array('required', 'class'=>'form-control', 'placeholder'=>'Product SKU')) !!}
            </div>

            <div class="form-group">
                  {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
            </div>

            <div class="form-group">
              <div class="input-group">
               <span class="input-group-addon">$</span>
    	             {!! Form::text('price', null, array('required', 'class'=>'form-control', 'placeholder'=>'9.99')) !!}

              </div>
            </div>

            <div class="form-group">
              {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>"message", 'maxlength'=>"233", 'rows'=>"7", 'placeholder'=>'Enter a short description')) !!}
              <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
             </div>


          </div><!-- .modal-body -->

          <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                    </div>
                    <div class="btn-group btn-delete hidden" role="group">
                      <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
                    </div>
                    <div class="btn-group" role="group">
                      {!! Form::submit('Create Product!', array('class'=>'btn btn-success')) !!}
                    </div>
                </div>
          </div>
       {!! Form::close() !!}
      </div>

    </div><!-- /.modal-dialog -->
  </div>  <!-- /.modal -->




 <!-- BID Modal dialog -->
  <div id="storeBid" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Bid</h4>
        </div>
  	{!! Form::open(array('route' => 'products.storeBid', 'id'=>'createBid', 'class' => 'form', 'novalidate' => 'novalidate')) !!}

          <div class="modal-body">
            {!! Form::hidden('product_id', 'product_id') !!}
            {!! Form::hidden('max', 'sad') !!}
            {!! Form::hidden('userTimezone', Auth::user()->timezone) !!}
           <input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
			 {!! Form::label('expirationDate', 'Expiration') !!}
				{!! Form::date('expirationDate',\Carbon\Carbon::now(), array('required', 'class'=>'form-control')) !!}
		</div>

		<div class="form-group">
			 {!! Form::label('expirationTime', 'ExpirationTime') !!}

				{!! Form::time('expirationTime',null, array('required', 'class'=>'form-control')) !!}

		</div>

		<div class="form-group">
	 {!! Form::label('amount', 'Minimum amount') !!}
				   {!! Form::number('amount', null, array('required',  'class'=>'form-control')) !!}
		</div>
    <div class="form-group">
	 {!! Form::label('reservedPrice', 'Reserved Price') !!}
				   {!! Form::number('reservedPrice', null, array('required',  'class'=>'form-control')) !!}
		</div>
          </div><!-- .modal-body -->

          <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                    </div>

                    <div class="btn-group" role="group">
                      {!! Form::submit('Create Bid', array('class'=>'btn btn-primary')) !!}
                    </div>
                </div>
          </div>
        {!! Form::close() !!}
      </div>

    </div><!-- /.modal-dialog -->
  </div>  <!-- /.modal -->


  <div id="buy" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Buy</h4>
        </div>
  	<form method="POST" action="{{ action('ProductController@buy') }}" accept-charset="UTF-8" class="form" id="purchase-form">
          <div class="modal-body">

           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <input type="hidden" name="product_id" value="">
           <div class="form-group">
                   <div class="row">
                       <div class="col-xs-12">
                           <label for="address" class="control-label">adress</label>
                       </div>
                       <div class="col-sm-4">
                           <input type="text"
                                  class="form-control"
                                  id="adress"
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
                        <button type="submit" class="submit-button btn btn-primary">Complete Order</button>
                    </div>
                </div>
          </div>
        </form>
      </div>

    </div><!-- /.modal-dialog -->
  </div>  <!-- /.modal -->
