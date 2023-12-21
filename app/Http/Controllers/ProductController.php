<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function productSave(Request $request)
    {
        // dd($request);
        // $productData = $request->validate([
        //     "name" => "required|unique:products",
        //     "description" => "required",
        //     "cost" => "required|min:1|",
        // ]);
        // dd($request->all());


        $fileName = time().'.'.$request->file('cover')->extension();
        $imagePath = $request->file('cover')->storeAs('public/imgs/products', $fileName);
        // dd($imagePath);

        if (!$request->product_id) {
            $product_id = Product::insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'cost' => $request->cost,
                'image' => $fileName,
                'type' => $request->product_type
            ]);
        } else {
            $product = Product::find($request->product_id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'cost' => $request->cost,
                    'image' => $fileName,
                    'type' => $request->product_type,
                    'updated_at'
                ]);
            $product_id = $request->product_id;
        }

        return redirect()->route('seeProduct', ['id' => $product_id]);
    }
    public function allProducts(Request $request)
    {

        if (!$request->filled('_token')) {
            $products = Product::paginate(4);
        } else {
            $types = array_keys($request->except('_token', 'order_by', 'sequence'));

            $products = DB::table('products')
                ->select()
                ->whereIn('type', $types)
                ->orderBy($request->order_by, $request->sequence)
                ->paginate(4);
        }


        $types = ProductType::all();

        $data = [
            'products' => $products,
            'types' => $types,
        ];

        return view("product.list", compact("data"));
    }
    public function seeProduct($id)
    {
        $product = Product::where("id", $id)->first();

        // dd($product);

        return view("product.only", compact("product"));
    }
    public function productEditor(Request $request)
    {
        $product = Product::find($request->id);
        $pTypes = ProductType::get()->all();
        // dd($pTypes);

        $data = [
            'product' => $product,
            'pTypes' => $pTypes
        ];

        return view("product.editor", compact('data'));
    }
    public function productDelete(Request $request)
    {
        $product = DB::table("products")->where('id', $request->id)->delete();

        return redirect()->route("shop");
    }
}
