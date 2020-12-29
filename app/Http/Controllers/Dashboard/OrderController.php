<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::whereHas('client',function ($q) use ($request){

            return $q->where('name','like','%'.$request->search . '%');

        })->paginate(5);

        return view('dashboard.orders.home',compact('orders'));
    }

    public function products(Order $order) {

        $products = $order->product;
        return view('dashboard.orders._products',compact('order','products'));

    }

    public function destroy(Order $order)
    {
        foreach ($order->product as $produc) {

            $produc->update([
                'stock' => $produc->stock + $produc->pivot->quantity
            ]);
        }


        $order->delete();
        session()->flash('success', __('site.delete_successfully'));
        return redirect()->route('dashboard.orders.index');
    }
}
