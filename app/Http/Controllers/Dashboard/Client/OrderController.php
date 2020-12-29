<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function create(Client $client)
    {

        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('product')->paginate(5);
        return view('dashboard.clients.orders.create', compact( 'client', 'categories', 'orders'));
    }


    public function store(Request $request , Client $client)
    {

        $request->validate([

            'products' => 'required|array',
//            'quantities' => 'required|array',
        ]);

        $this->attach_order($request , $client);

        session()->flash('success', __('site.add_successfully'));
        return redirect()->route('dashboard.orders.index');

    }


    public function edit(Client $client , Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('product')->paginate(5);

        return view('dashboard.clients.orders.edit',compact('client','order','categories','orders'));

    }


    public function update(Request $request, Client $client , Order $order)
    {


        $this->detach_order($order);
        $this->attach_order($request , $client);


        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');

    }


    private function attach_order($request,$client ) {

        $order = $client->orders()->create([]);

        $order->product()->attach($request->products);



        $total_price = 0;

        foreach ( $request->products as $id => $quantity) {


            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];


            $product->update([

                'stock' => $product->stock - $quantity['quantity']
            ]);
        } //end foreach

        $order->update([

            'total_price' => $total_price ,
        ]);

    }//end attach_order

    private function detach_order($order) {

        foreach ($order->product as $produc) {

            $produc->update([
                'stock' => $produc->stock + $produc->pivot->quantity
            ]);
        }


        $order->delete();
    }
}
