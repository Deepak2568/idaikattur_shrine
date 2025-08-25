<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(Request $request){
        $validated = $request->validate([
            'fname' => 'required|min:4|max:255',
            'lname' => 'required|min:4|max:255',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ],200);
        }

        Customer::create($validated);
        return response()->json([
            "status" => 200,
            "message" => 'Regstration Successfully, Now you can access the website....',
        ]);
    }
}
