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
    {   $user = Auth::user();
        $cart = Auth::user()->cart;
        $bids = Auth::user()->bid;
        $total=0;
       
        foreach ($cart as $item){
            $total=$total+$item->qty* $item->product->price;
           
        }
     

        return view('cart.index', compact('cart','total','bids'));
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
            if($item->product->id ==$product->id ){
                  $item->increment('qty');
                 $item->save();
                return redirect('/products');
            }
        }
        $cart = new Cart([
            'product_id' => $product->id,
            'qty' => $request->get('qty', 1),
            'price' => $product->price,
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
        Auth::user()->cart()
          ->where('id', $id)->firstOrFail()->delete();
        return redirect('/cart');
    }
    /**
     * Complete the order
     *
     * @param Request $request
     * @return $this|\Illuminate\View\View
     */
    public function complete(Request $request)
    {
        $user = Auth::user();
       
        // Add the order
        
        // Update the old cart
        foreach ($user->cart as $cart) {
            $cart->complete = 1;
            $cart->save();
        }
        return view('checkout.thankyou', compact('order'));
    }
}