<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Bids;
use Response;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Requests\BidCreateRequest;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    //
    public function storeBid(BidCreateRequest $request)
    {
      $price = $request->get('max');
      $date=$request->get('expirationDate');
      $time=$request->get('expirationTime');
      $timestamp = strtotime($date.$time.':01');
      $storedate=date("Y-m-d H:i:s", $timestamp);

          $bids = new Bids(array(
              'user_id'      => 0,
              'product_id'   => $request->get('product_id'),
              'expiration'   => $storedate,
              'amount'       => $request->get('amount'),
              'reservedPrice'=> $request-> get('reservedPrice')
          ));
          $bids->save();

      return \Redirect::route('products.index')
          ->with('message', 'Bid created!');
    }

    public function bid(Request $request)
    {
      $user = Auth::user();
          if(!$user->stripe_id)
              return \Redirect::route('user.index')->withErrors('Add your card please');

      $product = Product::findOrFail($request->get('product_id'));
      $this->validate($request, [
       'currentBid' => 'required|numeric|min:'.($product->bid->amount+1)
      ]);

          $product->bid->update([
            'amount'     => $request->get('currentBid'),
            'user_id'    => $user->id,
            'customerId' => $user->stripe_id
        ]);

      return \Redirect::route('products.index')
          ->with('message', 'Bid created!');
      }
      public function check($bid)//expired Bids calls this function
      {
        $bid= Bids::findOrFail(Input::get("bid"));
        $offset=Input::get("offset");
        if($offset<0)
        $now=\Carbon\Carbon::now()->subHours($offset);
        else
          $now=\Carbon\Carbon::now()->addHours($offset);

          if(strtotime($bid->expiration)-strtotime($now)<0)
        {
          //bid is expired
                  if($bid->amount<$bid->reservedPrice)
                  {
                    //void since bidding price is less then reserved price
                    $bid->delete();
                    return "Bidding price less then reserved price";
                  }else {
                    //proceed and Charge
                    //since we get information about expiration from client we have to check it on the server as well
                            //check wether winning user has its card working
                            if($bid->customerId){
                                    \Stripe\Stripe::setApiKey("sk_test_Z98H9hmuZWjFWfbkPFvrJMgk");
                                  \Stripe\Charge::create(array(
                                    "amount" => $bid->priceToCents(), // amount in cents, again
                                    "currency" => "usd",
                                    "customer" => $bid->customerId
                                    ));
                                    \Log::info('Charged: '. $bid->amount);
                              }
                          $bid->complete=1;
                          $bid->save();
                          $bid->delete();

                  }

        }else{
          //someone is messing with javascript
          return "error";
        }


        return "Bidding is valid";

      }

}
