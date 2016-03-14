<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    public function create(){
      
        if (Auth::check()){
                   return redirect()->intended('products');
                }



        return view('welcome');
    }
}
