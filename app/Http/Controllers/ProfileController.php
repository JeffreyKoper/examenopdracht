<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Product_cart;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function singleUserDashboard()
    {
        // Retrieve the currently authenticated user
        $user = auth()->user();

        // Check if the user is authenticated
        if ($user) {
            $contacts = Contact::where('user_id', $user->id)->get();
            $orderData = Cart::join('users', 'cart.user_id', '=', 'users.id')
                ->where('cart.user_id', $user->id)
                ->where('cart.payment_complete', 1)
                ->select('cart.id', 'users.id as user_id', 'users.name', 'cart.created_at', 'cart.total_price', 'cart.delivery_date', 'cart.code_used', 'cart.discounted_price', 'cart.code_used', 'cart.updated_at')
                ->get();
            $products = [];
            foreach ($orderData as $order) {
                $productCart = Product_cart::join('products', 'product_cart.product_id', '=', 'products.id')
                    ->where('product_cart.cart_id', $order->id)
                    ->select('product_cart.*', 'products.price as product_cart_price')
                    ->get();
                $products[$order->id] = $productCart;
            }
            return view('dashboard', ['data' => $user, 'orderData' => $orderData, 'contacts' => $contacts]);
        } else {
            // Handle the case where the user is not authenticated
            // Redirect to login or display an error message
            return redirect()->route('login')->with('error', 'Please log in to view this page');
        }
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function singleUserUpdate(Request $request)
    {
        $userId = auth()->user();
        $user = User::find($userId->id);
        $user->name = $request->accountName;
        $user->email = $request->accountEmail;
        $user->save();
        return redirect()->route('dashboard');
    }
    public function singleUserDelete(Request $request)
    {
        $userId = auth()->user();
        $user = User::find($userId->id);
        Auth::logout();
        $user->delete();
        return redirect()->route('home');
    }
    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->accountName;
        $user->email = $request->accountEmail;
        $user->role = $request->accountRole;
        $user->password = Hash::make($request->accountPassword);;
        $user->save();
        return redirect()->route('dashboard');
    }
}
