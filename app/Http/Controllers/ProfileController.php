<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\models\Category;
use App\models\Banner;
use App\models\Cart;
use App\models\Dish;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $categories = Category::all();
        $banners = Banner::all();
        $dishes = Dish::all();
        $carts = Cart::where('user_id',auth()->user()->id)->get();
        $dish_ids = $carts->pluck('dish_id')->toArray();
        $dishes_cart = Dish::whereIn('id', $dish_ids)->get()->keyby('id');
        return view('profile.edit', [
            'user' => $request->user(),
            "categories" => $categories,
            "banners" => $banners,
            "count_cart" => $carts->count(),
            "carts" => $carts,
            "dishes"=> $dishes,
            "dishes_cart" => $dishes_cart
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
}
