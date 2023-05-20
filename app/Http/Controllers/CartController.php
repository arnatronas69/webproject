<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = 1; // You can modify this to get the quantity from the request if needed

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->first();

        if ($cartItem) {
            // Update the quantity if the item already exists in the cart
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create a new cart item if it doesn't exist
            $cartItem = new Cart();
            $cartItem->user_id = auth()->id();
            $cartItem->product_id = $productId;
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return response()->json(['message' => 'Product added to cart successfully'], 200);
    }

    public function viewCart(Request $request)
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

    return view('pages.cart', [
        'cartItems' => $cartItems,
        'subtotal' => $subtotal,
        'total' => $total,
        'productNames' => $productNames,
        'productPrices' => $productPrices,
    ]);
}




    public function removeFromCart(Request $request, $id)
    {
        $user = $request->user();
        $cartItem = Cart::where('user_id', $user->id)->findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.view')->with('success', 'Product removed from cart successfully.');
    }

    public function getCartCount()
    {
        $user = auth()->user();
        $cartCount = Cart::where('user_id', $user->id)->count();

        return response()->json(['count' => $cartCount]);
    }

    public function updateQuantity(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $cartItem = Cart::where('user_id', $user->id)->findOrFail($id);
        $cartItem->quantity = $validatedData['quantity'];
        $cartItem->save();

        return response()->json(['quantity' => $cartItem->quantity]);
    }

}
