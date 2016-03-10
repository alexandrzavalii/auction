<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChargeBidSchedule extends Controller
{
    public function charge(){
        return view('about.index');
    }
}
