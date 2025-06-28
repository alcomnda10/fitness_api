<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function isNotAdmin()
    {
        $user = Auth::user();
        return !$user || !$user->is_admin;
    }

    public function stats()
    {
        if ($this->isNotAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'users_count' => User::count(),
            'orders_count' => Order::count(),
            'products_count' => Product::count()
        ]);
    }

    public function users()
    {
        if ($this->isNotAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(User::latest()->get());
    }

    public function products()
    {
        if ($this->isNotAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(Product::latest()->get());
    }

    public function orders()
    {
        if ($this->isNotAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(Order::latest()->get());
    }
}
