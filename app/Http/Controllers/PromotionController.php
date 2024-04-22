<?php

namespace App\Http\Controllers;

use App\Models\Promotions;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function checkPromoCode(Request $request)
    {
        $promoCode = $request->input('promo_code');

        // Assuming you have a Promotion model
        $promotion = Promotions::where('code', $promoCode)->first();

        if ($promotion && $promotion->valid && $promotion->uses >= 1) {
            return response()->json(['valid' => true, 'percentage' => $promotion->percentage]);
        } else {
            return response()->json(['valid' => false]);
        }
    }
}
