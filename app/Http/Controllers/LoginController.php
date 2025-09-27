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

    /**
     * Display the dashboard page for authenticated customers.
     * Updates the last_dashboard_visit timestamp once per day when the user visits the dashboard.
     * This helps track user activity and ensures the updated_at field is refreshed daily.
     */
    public function dashboard(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Update last_dashboard_visit if it's a new day
        if ($customer->shouldUpdateDashboardVisit()) {
            $customer->updateDashboardVisit();
        }

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

    public function viewProfile($id)
    {
        $currentCustomer = Auth::guard('customer')->user();
        
        // Check if current user is a paid member (active_status = 1)
        if ($currentCustomer->active_status != 1) {
            return response()->json([
                'status' => false,
                'message' => 'You need to be a paid member to view profiles. Please upgrade your membership.',
                'type' => 'membership_required'
            ]);
        }

        // Get the profile to view
        $profile = Customer::find($id);
        
        if (!$profile) {
            return response()->json([
                'status' => false,
                'message' => 'Profile not found.',
                'type' => 'not_found'
            ]);
        }

        // Return profile data
        return response()->json([
            'status' => true,
            'profile' => [
                'id' => $profile->id,
                'fname' => $profile->fname,
                'lname' => $profile->lname,
                'email' => $profile->email,
                'phone' => $profile->phone,
                'dob' => $profile->dob,
                'age' => \Carbon\Carbon::parse($profile->dob)->age,
                'gender' => $profile->gender,
                'religion' => $profile->religion,
                'subcaste' => $profile->subcaste,
                'state' => $profile->state,
                'city' => $profile->city,
                'profile_image' => $profile->profile_image,
                'active_status' => $profile->active_status,
                'created_at' => $profile->created_at->format('M d, Y'),
                'updated_at' => $profile->updated_at->format('M d, Y'),
                'last_dashboard_visit' => $profile->last_dashboard_visit ? $profile->last_dashboard_visit->format('M d, Y') : null,
                'profile_id' => 'SHM' . str_pad($profile->id, 2, '0', STR_PAD_LEFT),
                'address' => $profile->address,
                'height' => $profile->height,
                'weight' => $profile->weight,
                'body_type' => $profile->body_type,
                'complexion' => $profile->complexion,
                'blood_group' => $profile->blood_group,
                'physical_status' => $profile->physical_status,
                'marital_status' => $profile->marital_status,
                'education' => $profile->education,
                'education_details' => $profile->education_details,
                'employed_in' => $profile->employed_in,
                'occupation_details' => $profile->occupation_details,
                'occupation_category' => $profile->occupation_category,
                'working_state' => $profile->working_state,
                'working_place' => $profile->working_place,
                'salary' => $profile->salary,
                'father_name' => $profile->father_name,
                'father_occupation' => $profile->father_occupation,
                'mother_name' => $profile->mother_name,
                'mother_occupation' => $profile->mother_occupation,
                'brother_name' => $profile->brother_name,
                'brother_occupation' => $profile->brother_occupation,
                'brother_status' => $profile->brother_status,
                'sister_name' => $profile->sister_name,
                'sister_occupation' => $profile->sister_occupation,
                'sister_status' => $profile->sister_status,
                'partner_preference' => $profile->partner_preference
            ]
        ]);
    }


}
