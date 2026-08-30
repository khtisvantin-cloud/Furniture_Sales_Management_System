<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Furniture;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required', 'string']]);
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 422);
        }

        return response()->json(['token' => $user->createToken('api')->plainTextToken, 'user' => $user]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }

    public function furniture(): mixed { return Furniture::with('category')->paginate(); }
    public function categories(): mixed { return Category::paginate(); }
    public function customers(): mixed { return Customer::paginate(); }
    public function orders(): mixed { return Order::with('customer', 'items')->paginate(); }
}
