<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);

        $customer = Customer::where('email', $request->username)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            // Check if remember me is checked
            $remember = $request->has('rememberMe') && $request->rememberMe == 'on';
            
            // login customer with remember me functionality
            Auth::guard('customer')->login($customer, $remember);

            return response()->json([
                'status'   => true,
                'redirect' => route('dashboard')
            ]);
        }

        // Return field-specific error for invalid credentials
        return response()->json([
            'status'  => false,
            'errors' => [
                'invalid_cred' => ['Invalid credentials']
            ]
        ], 422);
    }

    public function dashboard(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Determine opposite gender
        $oppositeGender = $customer->gender === 'male' ? 'female' : 'male';

        // Query opposite-gender customers, exclude current user; 5 per page
        $profiles = Customer::where('gender', $oppositeGender)
            ->where('id', '!=', $customer->id)
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('shrine.dashboard', compact('customer', 'profiles', 'oppositeGender'));
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/matrimony');
    }
}
