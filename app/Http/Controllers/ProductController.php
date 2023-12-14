<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function productSave(Request $productRaw)
    {

        $productData = $productRaw->validate([
            "theme" => "required",
            "text" => "required",
        ]);

        $productType = ($productRaw->reply_to) ? 2 : 1;
        $productType = ($productRaw->product_type) ? $productRaw->product_type : $productType;

        if (!$productRaw->product_id) {
            $product_id = Product::insertGetId([
                'theme' => $productRaw->theme,
                'text' => $productRaw->text,
                'product_type_id' => $productType,
                'author_id' => Auth::id(),
                'reply_to' => (!empty($productRaw->reply_to)) ? $productRaw->reply_to : null,
            ]);
        } else {
            $product = Product::find($productRaw->product_id)
                ->update([
                    'theme' => $productRaw->theme,
                    'text' => $productRaw->text,
                    'updated_at'
                ]);
            $product_id = $productRaw->product_id;
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

        return view("product.editor", compact('product'));
    }
    public function productDelete(Request $request)
    {
        $product = DB::table("products")->where('id', $request->id)->delete();

        return redirect()->route("forum");
    }
}
