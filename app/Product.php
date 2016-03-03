<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   // use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'sku', 'price', 'description', 'is_downloadable','authorId'];

	public function orders()
	{
		return $this->hasMany('App\Order');
	}

    public function priceToCents()
    {
    	return $this->price * 100;
    }
        public function bid()
     {
         return $this->hasone('App\bids')
           ->where('complete', 0);
     }
}
