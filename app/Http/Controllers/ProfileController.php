<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;

class ProfileController extends Controller
{
    public function show()
    {
        $customer = Auth::guard('customer')->user();
        return view('profile.show', compact('customer'));
    }

    public function edit()
    {
        $customer = Auth::guard('customer')->user();
        return view('profile.edit', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'religion' => 'required|string|max:255',
            'subcaste' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = $request->only([
            'fname', 'lname', 'email', 'phone', 'dob', 'gender', 
            'religion', 'subcaste', 'state', 'city'
        ]);

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($customer->profile_image) {
                Storage::disk('public')->delete($customer->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $data['profile_image'] = $imagePath;
        }

        $customer->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function destroy(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        // Delete profile image if exists
        if ($customer->profile_image) {
            Storage::disk('public')->delete($customer->profile_image);
        }
        
        // Logout and delete account
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        $customer->delete();
        
        return redirect('/matrimony')->with('success', 'Your account has been deleted successfully.');
    }
}
