<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Product_cart;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    // Display single user's dashboard including recent contacts and orders
    // Display the user's profile form.
    public function singleUserDashboard()
    {
        // Retrieve the currently authenticated user
        $user = auth()->user();

        // Check if the user is authenticated
        if ($user) {

            //Retrieve the date 10 days ago
            $tenDaysAgo = Carbon::now()->subDays(10);

            // Retrieve messages within the last 10 days
            $contacts = Contact::where('user_id', $user->id)
                ->where('updated_at', '>=', $tenDaysAgo)
                ->get();
            //fetch all of the cart table where the user_id column is equal to the logged in user's id, and where the cart has been payed. 
            $orderData = Cart::join('users', 'cart.user_id', '=', 'users.id')
                ->leftJoin('promotions', 'cart.code_used', '=', 'promotions.id')
                ->where('cart.user_id', $user->id)
                ->where('cart.payment_complete', 1)
                ->select('cart.id', 'users.id as user_id', 'users.name', 'cart.created_at', 'promotions.code as code_used', 'cart.total_price', 'cart.delivery_date', 'cart.discounted_price', 'cart.updated_at')
                ->simplepaginate(3);

            $products = [];
            foreach ($orderData as $order) {
                // Fetch everything in the product cart table where the card_id column is equal to the order's id, then put it in a array.
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

    // Display profile edit form
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
    public function allUserDashboard()
    {
        $user = User::all();
        return view('users.show', ['user_data' => $user]);
    }
    public function editForm($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function updateUser(Request $request, $id)
    {
        $user_data = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        $user_data->name = $request->name;
        $user_data->email = $request->email;
        if ($request->has('password')) {
            $user_data->password = Hash::make($request->password);
        }
        $user_data->role = $request->role;

        $user_data->save();

        return redirect()->route('users.show')->with('success', 'user updated successfully.');
    }
    public function delete($id)
    {
        try {
            // Delete the promotion without foreign key constraint checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            User::where('id', $id)->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Redirect the user back to the promotions page
            return redirect()->route('users.show')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return redirect()->route('users.show')->with('error', 'An error occurred while deleting the user.');
        }
    }
    public function showCreate()
    {
        return view('users.create');
    }
}
