<?php 
namespace App\Composers;
use Illuminate\Support\Facades\Auth;

class NavComposer {
    
    public function compose($view){
        $count=0;
        if(Auth::guest()){
            $view->with('count',$count);
        }else{
            $cart = Auth::user()->cart;
            $bids = Auth::user()->bid;
            
             foreach ($cart as $item){
             $count=$count+$item->qty;
                                }
            
            foreach ($bids as $bid){
             $count=$count+1;
                                }
            
         $view->with('count',$count);
            
        }
    }
}