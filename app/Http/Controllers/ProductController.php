<?php namespace App\Http\Controllers;
  
  use App\Http\Requests;
  use App\Http\Controllers\Controller;
  use App\Product;
  use Illuminate\Http\Request;
  
  class ProductController extends Controller {
      
      public function __construct(){
        $this->middleware('auth');
    }
  
     public function index(Request $request)
	{
         
         if ($request->get('query')) {
             $this->validate($request, [
        'query' => 'required'
            ]);
             $search = $request->get('query');
             $products = Product::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $search . '%')->get();
             
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
 
 }