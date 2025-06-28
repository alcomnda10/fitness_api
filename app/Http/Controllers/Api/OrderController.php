<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'price' => 'required|numeric',
            'address.address' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.postal_code' => 'required|string',
            'payment_info.card_name' => 'required|string',
            'payment_info.card_number' => 'required|string',
            'payment_info.expiry' => 'required|string',
            'payment_info.cvc' => 'required|string',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'price' => $request->price,

            'address' => $request->address['address'],
            'city' => $request->address['city'],
            'state' => $request->address['state'],
            'postal_code' => $request->address['postal_code'],

            'card_name' => $request->payment_info['card_name'],
            'card_number' => $request->payment_info['card_number'],
            'expiry' => $request->payment_info['expiry'],
            'cvc' => $request->payment_info['cvc'],
        ]);

        return response()->json(['message' => 'Order placed successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'items' => 'sometimes|array',
            'items.*.product_id' => 'required_with:items|integer|exists:products,id',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'total' => 'sometimes|required|numeric',
        ]);

        if ($request->has('items')) {
            $order->items = $request->items;
        }
        if ($request->has('total')) {
            $order->total = $request->total;
        }

        $order->save();

        return response()->json($order, 200);
    }
}
