<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MatrimonyRegistrationSubmitted;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|min:2|max:100',
            'lname' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:255|unique:customers,email',
            'phone' => 'required|digits_between:10,15',
            'dob' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'religion' => 'required|string|max:50',
            'subcaste' => 'required|string|max:50',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            'termsAccepted' => 'accepted',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);
        

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = uniqid('profile_').'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('profile_images', $filename, 'public');
            $validated['profile_image'] = $path;
        }

        // Checkbox posts "on"; DB column is boolean/tinyint.
        $validated['termsAccepted'] = true;

        $customer = Customer::create($validated);

        $adminEmail = config('services.admin_email', 'jesurajadeepak@gmail.com');

        try {
            Mail::to($adminEmail)->send(new MatrimonyRegistrationSubmitted($customer));
        } catch (\Throwable $e) {
            Log::error('Matrimony registration mail failed', [
                'customer_id' => $customer->id,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Registration Successfully. Now you can access the website..... Please contact the churh member for further details to view the profiles.',
        ]);
    }
}
