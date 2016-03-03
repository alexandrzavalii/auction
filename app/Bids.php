<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
        

     protected $fillable = ['product_id', 'amount','expiration','user_id'];


     public function product()
     {
         return $this->belongsTo('App\Product');
     }

     public function user()
     {
         return $this->belongsTo('App\User');
     }
     public function priceToCents()
    {
    	return $this->amount * 100;
    }
}
