<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PropertyOptions;
use Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $orders = PropertyOptions::with('user')->with('property')->get();
        // $orders = Order::all();
        return view('admin.showOrder',compact('orders'));
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.ordershow',compact('order'));
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
       $order = PropertyOptions::find($id);
       $order->delete();
       session::flash('success','Record has been deleted Successfully');
       return redirect('admin/order');
    }
}
