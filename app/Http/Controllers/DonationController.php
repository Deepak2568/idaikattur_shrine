<?php

namespace App\Http\Controllers;

use App\Mail\DonationRequestSubmitted;
use App\Models\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DonationController extends Controller
{
    public function index()
    {
        return view('shrine.donate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|min:5|max:500',
            'amount' => 'nullable|numeric|min:1|max:99999999.99',
            'message' => 'nullable|string|max:5000',
        ]);

        $donation = DonationRequest::create([
            ...$validated,
            'status' => 'pending',
        ]);

        $adminEmail = config('services.admin_email', 'jesurajadeepak@gmail.com');

        try {
            Mail::to($adminEmail)->send(new DonationRequestSubmitted($donation));
        } catch (\Throwable $e) {
            Log::error('Donation request mail failed', [
                'donation_id' => $donation->id,
                'error' => $e->getMessage(),
            ]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 200,
                'message' => 'Thank you! Your donation interest has been received. The shrine will contact you soon. Online payment will be available later.',
            ]);
        }

        return redirect()->route('donate')
            ->with('success', 'Thank you! Your donation interest has been received. The shrine will contact you soon. Online payment will be available later.');
    }
}
