@extends('app')

@section('content')


<div class="col-md-6">

<h1>Create bid for product: {{$product->name}}</h1>
<h3>Today's date: {{\Carbon\Carbon::now()}}</h3>


{!! Form::open(array('route' => 'admin.products.storeBid', 'id'=>'createBid', 'class' => 'form', 'novalidate' => 'novalidate')) !!}
   {!! Form::hidden('product_id', $product->id) !!}
   {!! Form::hidden('max', $product->price) !!}

@if (count($errors) > 0)
	<div class="alert alert-danger">
		There were some problems with your input.<br />
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<div class="form-group">
    {!! Form::label('expirationDate', 'Expiration') !!}
    {!! Form::date('expirationDate',\Carbon\Carbon::now(), array('required', 'class'=>'form-control')) !!}

</div>
<div class="form-group">
    {!! Form::label('expirationTime', 'Expiration') !!}
    {!! Form::time('expirationTime',\Carbon\Carbon::now(), array('required', 'class'=>'form-control')) !!}

</div>

<div class="form-group">
    {!! Form::label('amount', 'Minimum amount') !!}
    {!! Form::number('amount', $product->price, array('required', 'max'=>233, 'class'=>'form-control')) !!}
</div>

<div class="form-group">
{!! Form::label('reservedPrice', 'Reserved Price') !!}
       {!! Form::number('reservedPrice', null, array('required',  'class'=>'form-control')) !!}
</div>


{!! Form::submit('Create Bid', array('class'=>'btn btn-primary')) !!}

{!! Form::close() !!}

</div>
@endsection
