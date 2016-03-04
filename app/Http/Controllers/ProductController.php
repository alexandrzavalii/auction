<?php namespace App\Http\Controllers;

  use App\Http\Requests;
  use App\Http\Controllers\Controller;
  use App\Product;
  use App\Bids;
  use File;
  use Carbon;
  use Illuminate\Http\Request;
  use App\Http\Requests\ProductCreateRequest;
  use App\Http\Requests\BidCreateRequest;
  use Illuminate\Support\Facades\Auth;

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
              foreach ($products as $product) {
                if($product->bid){
                if(strtotime($product->bid->expiration)-strtotime(Carbon\Carbon::now())<0){
                  if($product->bid->customerId){
                    \Stripe\Stripe::setApiKey("sk_test_Z98H9hmuZWjFWfbkPFvrJMgk");
                  \Stripe\Charge::create(array(
                    "amount" => $product->bid->priceToCents(), // amount in cents, again
                    "currency" => "usd",
                    "customer" => $product->bid->customerId
                    ));
                    }
                  $product->bid->delete();

                }
              }
              }
		return view('product.index', compact('products'));
	}



      public function show($id)
	{
		$product = Product::findOrFail($id);
		return view('product.show', compact('product'));
	}
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

	    return \Redirect::route('products.index')->with('message', 'The product has been added!');
	}
      	public function destroy($id)
	{
        $product = Product::findOrFail($id);
        $filename=$product->sku.'.png';
        $product->delete();
        if($product->bid){
        $product->bid->delete();
          }
          if($product->cart){
            $product->cart->delete();
          }
 File::delete(base_path() . '/public/imgs/products/'. $filename);


        return \Redirect::route('products.index')
            ->with('message', 'Product deleted!');
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
        return \Redirect::route('products.index')
            ->with('message', 'Bid created!');

    }
      public function bid($id)
      {
          //create the customer
\Stripe\Stripe::setApiKey("sk_test_Z98H9hmuZWjFWfbkPFvrJMgk");
            $token = $_POST['stripeToken'];
            $customer = \Stripe\Customer::create(array(
              "source" => $token,
              "description" => "Example customer")
            );


          //check the bid
		     $product = Product::findOrFail($id);
         $bidUpCents=$product->bid->priceToCents() + 1000;
          $bidUpdate=$product->bid->amount+10;
          $user = Auth::user();
//create customer
          $product->bid->update([
            'amount' => $bidUpdate,
            'user_id' => $user->id,
            'customerId' => $customer->id
        ]);





          return \Redirect::route('products.index')
          ->with('message', 'Your account will be charged at: '. $product->bid->expiration);
      }

 }
