<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function ProductSave(Request $ProductRaw)
    {

        $ProductData = $ProductRaw->validate([
            "theme" => "required",
            "text" => "required",
        ]);

        if (!$ProductRaw->Product_id) {
            $Product_id = Product::insertGetId([
                'theme' => $ProductRaw->theme,
                'text' => $ProductRaw->text,
                'Product_type_id' => 1,
                'author_id' => Auth::id(),
                'reply_to' => null,
            ]);
        } else {
            $Product = Product::find($ProductRaw->Product_id)
                ->update([
                    'theme' => $ProductRaw->theme,
                    'text' => $ProductRaw->text,
                ]);
            $Product_id = $ProductRaw->Product_id;
        }

        return redirect()->route('seeProduct', ['id' => $Product_id]);
    }
    public function allProducts()
    {
        $Products = Product::paginate(10)->where('Product_type_id', 1);

        return view("Product.forum", compact("Products"));
    }
    public function seeProduct($request)
    {

        $Product = Product::where("id", $request)->first();

        return view("Product.only", compact("Product"));
    }
    public function ProductEditor()
    {
        return view("Product.editor");
    }

    public function ProductEdit(Request $request)
    {
        $Product = Product::find($request->id);

        return view('Product.editor', compact('Product'));
    }
    public function ProductDelete(Request $request)
    {
        $Product = DB::table("Products")->where('id', $request->id)->delete();

        return redirect()->route("forum");
    }
}
