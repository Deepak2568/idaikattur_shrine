<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //
    public function register(Request $request){
        $validated = $request->validate([
            'fname'                => 'required|string|min:2|max:100',
            'lname'                => 'required|string|min:2|max:100',
            'email'                => 'required|email|max:255|unique:customers,email',
            'phone'                => 'required|digits_between:10,15',
            'dob'                  => 'required|date|before:today',
            'gender'               => 'required|in:male,female',
            'religion'             => 'required|string|max:50',
            'subcaste'             => 'required|string|max:50',
            'state'                => 'required|string|max:100',
            'city'                 => 'required|string|max:100',
            'password'             => 'required|string|min:8|confirmed',
            'termsAccepted'        => 'accepted',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // if ($validated->fails()) {
        //     return response()->json([
        //         'status' => 422,
        //         'errors' => $validator->errors()
        //     ],200);
        // }
      
        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_images', $filename, 'public');
            $validated['profile_image'] = $path;
        }
        Customer::create($validated);
        return response()->json([
            "status" => 200,
            "message" => 'Registration Successfully. Now you can access the website....',
        ]);
    }
}
