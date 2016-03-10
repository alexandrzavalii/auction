<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, BillableContract {

	use Authenticatable, CanResetPassword, Billable;
	protected $table = 'users';
	protected $fillable = ['name', 'email', 'password','stripe_id'];

	protected $hidden = ['password', 'remember_token','stripe_id'];

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];
    public function cart()
     {
         return $this->hasMany('App\Cart')
           ->where('complete', 0);
     }

     public function bid()
     {
         return $this->hasMany('App\Bids')
           ->where('complete', 0);
     }


}
