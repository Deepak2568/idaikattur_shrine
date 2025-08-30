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
            'address' => 'nullable|string|max:1000',
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'body_type' => 'nullable|in:slim,average,athletic,curvy,plus_size',
            'complexion' => 'nullable|in:very_fair,fair,wheatish,wheatish_brown,black',
            'blood_group' => 'nullable|string|max:10',
            'physical_status' => 'nullable|in:normal,physically_challenged',
            'marital_status' => 'nullable|in:unmarried,married,widowed,divorced',
            'education' => 'nullable|in:high_school,diploma,bachelor,master,phd,other',
            'education_details' => 'nullable|string|max:255',
            'employed_in' => 'nullable|in:private,government,others',
            'occupation_details' => 'nullable|string|max:255',
            'occupation_category' => 'nullable|string|max:255',
            'working_state' => 'nullable|string|max:255',
            'working_place' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:100',
            'father_name' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'brother_name' => 'nullable|string|max:255',
            'brother_occupation' => 'nullable|string|max:255',
            'brother_status' => 'nullable|in:married,unmarried',
            'sister_name' => 'nullable|string|max:255',
            'sister_occupation' => 'nullable|string|max:255',
            'sister_status' => 'nullable|in:married,unmarried',
            'partner_preference' => 'nullable|string|max:1000',
        ]);

        $data = $request->only([
            'fname', 'lname', 'email', 'phone', 'dob', 'gender', 
            'religion', 'subcaste', 'state', 'city', 'address', 'height', 'weight',
            'body_type', 'complexion', 'blood_group', 'physical_status', 'marital_status',
            'education', 'education_details', 'employed_in', 'occupation_details',
            'occupation_category', 'working_state', 'working_place', 'salary',
            'father_name', 'father_occupation', 'mother_name', 'mother_occupation',
            'brother_name', 'brother_occupation', 'brother_status',
            'sister_name', 'sister_occupation', 'sister_status', 'partner_preference'
        ]);

        // Handle password update - will be automatically hashed by the model mutator
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($customer->profile_image) {
                Storage::disk('public')->delete($customer->profile_image);
            }
            
            $file = $request->file('profile_image');
            $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('profile_images', $filename, 'public');
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
