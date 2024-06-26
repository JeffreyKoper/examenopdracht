<?php

namespace App\Http\Controllers;

use App\Models\Promotions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    // Display promotion creation form
    public function createForm()
    {
        return view('promo.create');
    }

    // Create a new promotion
    public function create(Request $request)
    {
        $promoCode = new Promotions();

        $request->validate([
            'code' => 'required|string',
            'uses' => 'required|integer',
        ]);
        $promoCode->code = $request->code;
        $promoCode->uses = $request->uses;
        $promoCode->percentage = $request->percentage;
        $promoCode->valid = $request->valid;

        $promoCode->save();

        return redirect()->route('promo.show');
    }

    // Display all promotions
    public function show()
    {
        $promo = Promotions::all();
        return view('promo.show', ['promo_data' => $promo]);
    }

    // Delete a promotion
    public function delete($id)
    {
        try {
            // Delete the promotion without foreign key constraint checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Promotions::where('id', $id)->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Redirect the user back to the promotions page
            return redirect()->route('promo.show')->with('success', 'Promotion deleted successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return redirect()->route('promo.show')->with('error', 'An error occurred while deleting the promotion.');
        }
    }

    // Check if a promo code is valid
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

    // Display promotion edit form
    public function editForm($id)
    {
        $promo = Promotions::findOrFail($id);
        return view('promo.edit', compact('promo'));
    }

    // Update an existing promotion
    public function update(Request $request, $id)
    {
        $promoCode = Promotions::findOrFail($id);

        $request->validate([
            'code' => 'required|string',
            'uses' => 'required|integer',
        ]);

        $promoCode->code = $request->code;
        $promoCode->uses = $request->uses;
        $promoCode->percentage = $request->percentage;
        $promoCode->valid = $request->valid;

        $promoCode->save();

        return redirect()->route('promo.show')->with('success', 'Promotion updated successfully.');
    }
}
