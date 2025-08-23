<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    // public function index(){
    //     return view("contact");
    // }
    public function store(Request $request){
        // dd($request->all());
        // return view("contact");
        $request->validate([
            "user_name" => 'required',
            'email' => 'required|email|unique:contacts,email',
            'subject' => 'required',
            'message' => 'required'
        ]);
    }
}
