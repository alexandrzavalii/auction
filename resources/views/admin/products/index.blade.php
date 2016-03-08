@extends('app')

@section('content')

<h1>Manage Products</h1>
@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
  @if (count($products) > 0)

<p>
<a href="{{ URL::Route('admin.products.create') }}" class="btn btn-success">Create a Product</a>
</p>

      <table class="table">
      <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th></th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      @foreach ($products as $product)

        <tr>
          <td>
            <a href="{{ URL::route('admin.products.edit', $product->id) }}">{{ $product->name }}</a>
          </td>
          <td>
            ${{ $product->price }}
          </td>
          <td>
             @foreach ($bids as $bid)
                 @if($bid->product_id== $product->id)
                 <a class="btn btn-danger" href="{{ URL::route('admin.products.deleteBid', $product->id) }}">Delete Bid</a>
                 @endif
              @endforeach
                               <a class="btn btn-warning" href="{{ URL::route('admin.products.createBid', $product->id) }}">Create Bid</a>
          </td>
          <td>
            {!! Form::open(array('route' => array('admin.products.destroy', $product->id), 'method' => 'delete')) !!}
              <button type="submit" class="btn btn-danger" href="{{ URL::route('admin.products.destroy', $product->id) }}" title="Delete Product">
              Delete
              </button>
            {!! Form::close() !!}
          </td>

        </tr>

      @endforeach
      </tbody>
      </table>


    @else
     <p>
      You haven't created any products. <a href="/admin/product/create">Create a Product</a>
    </p>
    @endif

@endsection
