<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function productSave(Request $request)
    {
        // dd($request);
        $productData = $request->validate([
            "name" => "required|unique:products",
            "description" => "required",
            "cost" => "required|min:1|",
        ]);

        if (!$request->product_id) {
            $product_id = Product::insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'cost' => $request->cost,
                'image' => 'default.png',
                'type' => $request->product_type
            ]);
        } else {
            $product = Product::find($request->product_id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'cost' => $request->cost,
                    'image' => 'default.png',
                    'updated_at'
                ]);
            $product_id = $request->product_id;
        }

        return redirect()->route('seeproduct', ['id' => $product_id]);
    }
    public function allProducts()
    {
        $products = Product::paginate(10);

        return view("product.forum", compact("products"));
    }
    public function seeProduct($id)
    {
        $product = Product::where("id", $id)->first();
        
        $theme = ['firstproduct' => $product];

        if ($product) {
            $replies = optional($product->replies)->toArray();
            $theme += ['replies' => $replies];
        }

        // dd($theme);

        return view("product.only", compact("theme"));
    }
    public function productEditor(Request $request)
    {
        $product = Product::find($request->id);
        $pTypes = ProductType::get()->all();

        $data = [
            'product' => $product,
            'pTypes' => $pTypes
        ];

        return view("product.editor", compact('data'));
    }
    public function productDelete(Request $request)
    {
        $product = DB::table("products")->where('id', $request->id)->delete();

        return redirect()->route("forum");
    }
}
