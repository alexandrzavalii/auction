@extends('app')

@section('content')

<h1>Administration Console</h1>

<ul>
	<li>{!! link_to_route('admin.orders.index', 'Manage Orders') !!}</li>
	<li>{!! link_to_route('admin.products.index', 'Manage Products') !!}</li>
</ul>

@endsection