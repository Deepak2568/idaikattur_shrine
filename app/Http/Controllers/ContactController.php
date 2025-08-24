<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    // public function index(){
    //     return view("contact");
    // }
    public function store(Request $request){
        // dd($request->all());
        // return view("contact");
       // 1. Validate input
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:contacts,email',
            'subject'   => 'required|string|max:255',
            'message'   => 'required|string',
        ]);

        // 2. Save data (make sure your Contact model has $fillable set)
        Contact::create($validated);
        return redirect()
        ->route('contact')
        ->with('success', 'Your message has been sent. Thank you!');
    }
}
