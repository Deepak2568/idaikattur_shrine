<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class AdminController extends Controller
{
    //
    public function index(){
        $customer = Customer::all();
        return view('shrine.admin',['data'=>$customer]);
    }

    public function update(Request $request, $id){
        $customer = Customer::findorfail($id);
        $customer->active_status = 1; // set to Paid
        $customer->save();

        return redirect()->route('admin')->with('success', 'Customer activated successfully!');
    }

    public function destroy(Request $request, $id){
        $customer = Customer::findorfail($id);
        $customer->delete();
        return redirect()->route('admin')->with('removed', 'Customer deleted successfully!');
    }
}
