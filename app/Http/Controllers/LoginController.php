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
            // login customer
            Auth::guard('customer')->login($customer);

            return response()->json([
                'status'   => true,
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Invalid email or password'
        ]);
    }

    public function dashboard()
    {
        $customer = Auth::guard('customer')->user();
        return view('shrine.dashboard', compact('customer'));
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/matrimony');
    }
}
