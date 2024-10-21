<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStrength;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function strengthByProduct($id)
    {
        $product = Product::where('id', $id)->with('productStrengths')->first();;

        return response()->json($product);
    }
}
