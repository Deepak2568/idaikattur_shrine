<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormSubmitted;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+\-\s()]{7,30}$/'],
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'user_name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please enter your message.',
        ]);

        $contact = Contact::create($validated);

        $adminEmail = config('services.admin_email', 'jesurajadeepak@gmail.com');

        try {
            Mail::to($adminEmail)->send(new ContactFormSubmitted($contact));
        } catch (\Throwable $e) {
            Log::error('Contact form mail failed', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage(),
            ]);

            return redirect('/contact')
                ->withInput()
                ->with('error', 'Your message was saved, but we could not send the email right now. Please try again later or call the shrine.');
        }

        return redirect('/contact')
            ->with('success', 'Your message has been sent. Thank you!');
    }
}
