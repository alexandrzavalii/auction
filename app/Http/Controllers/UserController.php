<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
  }
    public function index()
    {
      return view('user.index');
    }
    public function saveCard(Request $request)
    {
      $user = Auth::user();
      if($request->get('stripe_token')){
        \Stripe\Stripe::setApiKey("sk_test_Z98H9hmuZWjFWfbkPFvrJMgk");
          $customer = \Stripe\Customer::create(array(
            "source" => $request->get('stripe_token'),
            "description" => $user->id)
          );

          $user->update([
            'stripe_id' => $customer->id
        ]);
        return \Redirect::route('user.index')->with('message', 'Card is saved');
      } else {
      return \Redirect::route('products.index')->withErrors('Failed to save');
    }


    }
}
