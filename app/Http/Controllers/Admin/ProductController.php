<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;
use DateTime;
use App\Product;
use App\Bids;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\BidCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
	public function index()
	{
		$products = Product::all();
        $bids = Bids::all();
		return view('admin.products.index', compact('products','bids'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ProductCreateRequest $request)
	{

	    $product = new Product(array(
	      'name'        => $request->get('name'),
	      'sku'         => $request->get('sku'),
	      'price'       => $request->get('price'),
	      'description' => $request->get('description'),
	      'is_downloadable' => $request->get('is_downloadable'),
            'authorId' => Auth::user()->id
	    ));

	    $product->save();

	    // Process the uploaded image

      	$imageName = $product->sku. '.' . $request->file('image')->getClientOriginalExtension();
      	
      	$request->file('image')->move(base_path() . '/public/imgs/products/', $imageName);

      	// Process the electronic download
      	 
      	if ($request->file('download')) {

	        $downloadName = $product->sku. '.' . $request->file('download')->getClientOriginalExtension();
	      	
	      	$request->file('download')->move(storage_path() . '/downloads/', $downloadName);
    	
	      	$product->download = $downloadName;
	      	$product->save();

		}

	    return \Redirect::route('admin.products.edit', 
	    	array($product->id))->with('message', 'The product has been added!');	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = Product::findOrFail($id);
         
		$slug = Str::slug($product->name);
		return view('admin.products.edit', compact('product', 'slug', 'image'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ProductCreateRequest $request, $id)
	{
		$product = Product::findOrFail($id);

        $product->update([
            'name' => $request->get('name'), 
            'sku' => $request->get('sku'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'is_downloadable' => $request->get('is_downloadable')
        ]);
        

        $imageName = $product->sku. '.' . $request->file('image')->getClientOriginalExtension();
      	$request->file('image')->move(base_path() . '/public/imgs/products/', $imageName);


        
	    return \Redirect::route('admin.products.edit', 
	    	array($product->id))->with('message', 'The product has been updated!');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $product = Product::findOrFail($id);
        $filename=$product->sku.'.png';
        $product->delete();
 File::delete(base_path() . '/public/imgs/products/'. $filename); 
        

        return \Redirect::route('admin.products.index')
            ->with('message', 'Product deleted!');
	}
    
    public function createBid($id)
	{
        $product = Product::findOrFail($id);
        		$bids = Bids::all();
            return view('admin.products.createBid', compact('product'));

	}
    public function storeBid(BidCreateRequest $request)
    {
        
        $date=$request->get('expirationDate');
        $time=$request->get('expirationTime');
        $timestamp = strtotime($date.$time.':01');
        $storedate=date("Y-m-d H:i:s", $timestamp);
        
      $bids = new Bids(array(
	      'user_id' => 0,
	      'product_id' => $request->get('product_id'),
	      'expiration' => $storedate,
          'amount' => $request->get('amount')
	    ));
        $bids->save();
        return \Redirect::route('admin.products.index')
            ->with('message', 'Bid created!');
        
    }
    public function deleteBid($id)
    {
        $bid = Bids::where('product_id', '=', $id);
        $bid->delete();
        return \Redirect::route('admin.products.index')
            ->with('message', 'Bid deleted!');
    }

}
