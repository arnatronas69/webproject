<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = $request->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        $subtotal = 0;
        $productNames = [];
        $productPrices = [];

        foreach ($cartItems as $cartItem) {
            $subtotal += $cartItem->product->price;
            $productNames[] = $cartItem->product->name;
            $productPrices[] = $cartItem->product->price;
        }

        // You can calculate any additional charges or discounts here if needed
        $total = $subtotal;

        return view('pages.checkout', compact('cartItems', 'productNames', 'productPrices', 'total'));
    }

    public function processCheckout(Request $request)
{
    // Retrieve the necessary data from the request
    $user = $request->user();
    $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

    $order = new Order();
    $order->first_name = $request->input('first_name');
    $order->last_name = $request->input('last_name');
    $order->email = $request->input('email');
    $order->phone_number = $request->input('phone_number');
    $order->company_name = $request->input('company_name');
    $order->address_line_1 = $request->input('address_line_1');
    $order->address_line_2 = $request->input('address_line_2');
    $order->town_city = $request->input('town_city');
    $order->state = $request->input('state');
    // Add other order details here
    $order->save();

    foreach ($cartItems as $cartItem) {
        $order->items()->attach($cartItem->product_id, [
            'item_price' => $cartItem->product->price,
            // Add other item details here
        ]);
    }

    // Clear the cart after placing the order
    Cart::where('user_id', $user->id)->delete();

    // Redirect to a success page or display a success message
    return redirect()->route('checkout.success');
}
}
