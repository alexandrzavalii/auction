<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Bids;
use App\Http\Requests;
use App\Http\Requests\BidCreateRequest;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    //
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
        'amount' => $request->get('amount'),
        'reservedPrice'=> $request-> get('reservedPrice')
    ));
      $bids->save();
      return \Redirect::route('products.index')
          ->with('message', 'Bid created!');

    }

    public function bid(Request $request)
    {
      $user = Auth::user();
      if(!$user->stripe_id){
        return \Redirect::route('user.index')->withErrors('Add your card please');
      }

      $product = Product::findOrFail($request->get('product_id'));


      $this->validate($request, [
       'currentBid' => 'required|numeric|min:'.($product->bid->amount+1)
      ]);


        $product->bid->update([
          'amount' => $request->get('currentBid'),
          'user_id' => $user->id,
          'customerId' => $user->stripe_id
      ]);

      return \Redirect::route('products.index')
          ->with('message', 'Bid created!');

}
}

  /*
          return view('checkout.thankyou');
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
        }else{
          \Redirect::route('products.index')
              ->withErrors('Ammount is required!');
        }
*/
