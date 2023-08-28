<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function store(Request $request)
    {

        return $request;
    }
    public function get_products($section_id)
    {

        return response()->json(Section::find($section_id)->products->pluck('id', 'Product_name'));
    }
    public function get_price($product)
    {
        return response()->json(Product::find($product)->price);
    }
    public function store_order(Request $request)
    {


        $order = Order::create([
            'payment_type' => 'cashe',
        ]);
        // return  $order;

        for ($i = 0; $i <= count($request->products) - 1; $i++) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $request->products[$i],
                'section_id' => $request->sections[$i],
                'mount' => $request->sections[$i],
                'total' => $request->totals[$i],
                'discount' => $request->discounts[$i],
            ]);
        }
        $orderbacks = $order->order_details;
        return view('cashier.cashier', compact('orderbacks'));
    }
}
