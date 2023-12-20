<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    //
    public function addToCart(Request $request)
    {

        Basket::create([
            'product_id' => $request->id,
            'orderer_id' => auth()->user()->id,
            'status' => 1
        ]);

        return redirect()->route('seeProduct', ['id' => $request->id]);
    }

    public function changeStatus()
    {
        $balance = Auth::user()->balance;
        $basket = Basket::where('orderer_id', Auth::user()->id)->get();

        $totalCost = 0;
        foreach ($basket as $order) {
            $totalCost = $totalCost + $order->cost;
        }

        if ($balance >= $totalCost) {
            $newBalance = $balance - $totalCost;
            Auth::user()->update([
                'balance' => $newBalance
            ]);
            return redirect()->route('user')->with('success', 'Оплата завершена');
        }

        return redirect()->route('user')->with('success', 'Оплата завершена');
    }
}
