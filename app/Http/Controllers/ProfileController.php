<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $pickup_data = Cart::join('users', 'cart.user_id', '=', 'users.id')
            ->where('cart.payment_complete', 1)
            ->get(['cart.id', 'users.name', 'cart.delivery_date']);
            return view('dashboard', ['data' => $user, 'pickup_data' => $pickup_data]);
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

    public function singleUserUpdate(Request $request){
        $user_id = auth()->user();
        $user = User::find($user_id->id);
        $user->name = $request->accountName;
        $user->email = $request->accountEmail;
        $user->save();
        return redirect()->route('dashboard');
    }
    public function singleUserDelete(Request $request){
        $user_id= auth()->user();
        $user = User::find($user_id->id);
        Auth::logout();
        $user->delete();
        return redirect()->route('home');
    }
}
