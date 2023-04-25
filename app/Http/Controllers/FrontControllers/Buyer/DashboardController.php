<?php

namespace App\Http\Controllers\FrontControllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view("buyer.index");   
    }
}
