
  <!-- Log in Modal dialog -->
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
              <label class="col-md-4 control-label">{!! Form::label('name', 'Product Name') !!}</label>
    <div class="col-md-6">
    {!! Form::text('name', null, array('required', 'class'=>'form-control', 'placeholder'=>'Product Name')) !!}
              </div>
         </div>

            <div class="form-group">
              <label class="col-md-4 control-label">{!! Form::label('sku', 'Product SKU') !!}</label>
              <div class="col-md-6">
                {!! Form::text('sku', null, array('required', 'class'=>'form-control', 'placeholder'=>'LAWN-1234')) !!}
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-4 control-label">{!! Form::label('image', 'Product Image') !!}</label>
              <div class="col-md-6">
                  {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
              </div>
            </div>

                        <div class="form-group">
              <label class="col-md-4 control-label">{!! Form::label('price', 'Price') !!}</label>
              <div class="col-md-6 input-group">
               <span class="input-group-addon">$</span>
    	             {!! Form::text('price', null, array('required', 'class'=>'form-control', 'placeholder'=>'9.99')) !!}
              
              </div>
            </div>
            
            <div class="form-group">
    {!! Form::label('description', 'Product Description') !!}
    {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Enter a short description')) !!}
             </div>
        
          </div><!-- .modal-body -->

          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Create Product!', array('class'=>'btn btn-primary')) !!}
          </div>
       {!! Form::close() !!}
      </div>

    </div><!-- /.modal-dialog -->
  </div>  <!-- /.modal -->


  
 
 <!-- Reset Password Modal dialog -->
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
           <input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
			<label class="col-md-4 control-label"> {!! Form::label('expirationDate', 'Expiration') !!}</label>
			<div class="col-md-6">
				{!! Form::date('expirationDate',\Carbon\Carbon::now(), array('required', 'class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label"> {!! Form::label('expirationTime', 'Expiration') !!}</label>
			<div class="col-md-6">
				{!! Form::time('expirationTime',null, array('required', 'class'=>'form-control')) !!}
			</div>
		</div>
    
		<div class="form-group">
			<label class="col-md-4 control-label">    {!! Form::label('amount', 'Minimum amount') !!}</label>
			<div class="col-md-6">
				   {!! Form::number('amount', null, array('required', 'max'=>233, 'class'=>'form-control')) !!}
			</div>
		</div>

          </div><!-- .modal-body -->

          <div class="modal-footer">
           <button type="button" class="button" data-dismiss="modal">Cancel</button>
           {!! Form::submit('Create Bid', array('class'=>'btn btn-primary')) !!}
          </div>
        {!! Form::close() !!}
      </div>

    </div><!-- /.modal-dialog -->
  </div>  <!-- /.modal -->
  