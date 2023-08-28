<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\PruductRequest;
use App\Notifications\ProductNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::get();
        $sections = Section::get();

        return view('Product.products', compact('sections', 'products'));
    }

    public function store_product(PruductRequest $request)
    {
        // "Product_name": "جرجير",
        // "Product_price": "100",
        // "section_id": "1",
        // "description": null
        // ---------------------------------
        $product =   Product::create([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
            'price' => $request->Product_price,
        ]);
        $users = User::get();
        Notification::send($users, new ProductNotification($product));
        return redirect()->back()->with('msg_product_s', "تم اضافه المنتج بنجاح");
    }
    public function update_product(PruductRequest $request)
    {


        Product::find($request->pro_id)->update([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
            'price' => $request->Product_price,


        ]);
        return redirect()->back()->with('msg_product_s', "تم تعديل المنتج بنجاح");
    }
    public function product_delete(Request $request)
    {


        Product::find($request->pro_id)->delete();
        return redirect()->back()->with('msg_product_s', "تم حذف المنتج بنجاح");
    }
}
