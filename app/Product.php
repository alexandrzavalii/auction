<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   // use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'sku', 'price', 'description', 'is_downloadable'];

	public function orders()
	{
		return $this->hasMany('App\Order');
	}

    public function priceToCents()
    {
    	return $this->price * 100;
    }
}
