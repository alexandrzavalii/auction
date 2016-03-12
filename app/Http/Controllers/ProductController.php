<?php

namespace App\Http\Controllers;
  use App\Product;
  use File;
  use Illuminate\Http\Request;
  use App\Http\Requests\ProductCreateRequest;
  use Illuminate\Support\Facades\Auth;
  
  class ProductController extends Controller
  {
      public function __construct()
      {
          $this->middleware('auth');
      }

      public function index(Request $request)
      {
          //search query

           if ($request->get('query'))
           {
             $this->validate($request, [
               'query' => 'required',]);

               $search = $request->get('query');
               $products = Product::orderBy('name', 'asc')->where('name', 'LIKE', '%'.$search.'%')->get();
               return view('product.index', compact('products'));
           }

          $products = Product::orderBy('name', 'asc')->get();
          return view('product.index', compact('products'));
      }

      public function show($id)
      {
          $product = Product::findOrFail($id);
          return view('product.show', compact('product'));
      }
      public function buy($id)
      {
          $user = Auth::user();
          $product = Product::findOrFail($id);

          if ($user->stripe_id)
          {
              \Stripe\Stripe::setApiKey('sk_test_Z98H9hmuZWjFWfbkPFvrJMgk');
              \Stripe\Charge::create(array(
                  'amount' => $product->priceToCents(), // amount in cents, again
                  'currency' => 'usd',
                  'receipt_email' => $user->email,
                  'customer' => $user->stripe_id,
                  'metadata' => [
                      'name' => $user->name,
                    ],
                  ));
          } else
              return \Redirect::route('user.index')->withErrors('Add your card please');

          return view('checkout.thankyou');
      }
      public function store(ProductCreateRequest $request)
      {
            $product = new Product(array(
            'name' => $request->get('name'),
            'sku' => $request->get('sku'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'is_downloadable' => $request->get('is_downloadable'),
              'authorId' => Auth::user()->id,
          ));

            $product->save();
          // Process the uploaded image
            $imageName = $product->sku.'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path().'/public/imgs/products/', $imageName);

          return \Redirect::route('products.index')->with('message', 'The product has been added!');
      }
      public function destroy($id)
      {
              $product = Product::findOrFail($id);
              $filename = $product->sku.'.png';
              $product->delete();
              if ($product->bid) $product->bid->delete();
              if ($product->cart) $product->cart->delete();

              File::delete(base_path().'/public/imgs/products/'.$filename);

            return \Redirect::route('products.index')
              ->with('message', 'Product deleted!');
      }
  }
