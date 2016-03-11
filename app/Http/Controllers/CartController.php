<?php namespace App\Http\Controllers;
use App\Cart;
use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the cart
     */
    public function index()
    {
            $user = Auth::user();
            $cart = Auth::user()->cart;
            $bids = Auth::user()->bid;

        return view('cart.index', compact('cart','bids'));
    }
    /**
     * Add an item to the cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $product = Product::find($request->get('product_id'));
        $cart = Auth::user()->cart;
            foreach ($cart as $item){
                if($item->product->id ==$product->id )
                {
                      $item->increment('qty');
                      $item->save();
                    return redirect('/products');
                }
            }
        $cart = new Cart([
            'product_id' => $product->id,
            'qty'        => $request->get('qty', 1),
            'price'      => $product->price,
        ]);

        Auth::user()->cart()->save($cart);
        return redirect('/products');
    }
    /**
     * Remove an item from the cart
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove($id)
    {
        Auth::user()->cart()->where('id', $id)->firstOrFail()->delete();
        return redirect('/cart');
    }
    /**
     * Complete the order
     *
     * @param Request $request
     * @return $this|\Illuminate\View\View
     */
    public function buy()
    {
      $user = Auth::user();
      $cart = Auth::user()->cart;
      $total=0;
      $shipping=7;

        if($user->stripe_id)
        {
            foreach ($cart as $item){
                $total=$total+$item->qty* $item->product->price;
            }

            \Stripe\Stripe::setApiKey("sk_test_Z98H9hmuZWjFWfbkPFvrJMgk");
            \Stripe\Charge::create(array(
                  'amount'        => ($total+$shipping)*100, // amount in cents, again
                  'currency'      => "usd",
                  'receipt_email' => $user->email,
                  'customer'      => $user->stripe_id,
                  'metadata'      => [
                  'name'          => $user->name,
              ],
              ));

              foreach ($user->cart as $cart) {
                  $cart->complete = 1;
                  $cart->save();
              }

        }else
          return \Redirect::route('user.index')->withErrors('Add your card please');


      return view('checkout.thankyou', compact('order'));
    }
}
