<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Setting;

class AdminController extends Controller
{
    //
    public function index(Request $request){
        // Check if the logged in user is an admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->route('matrimony');
        }

        $customer = Customer::all();
        return view('shrine.admin',['data'=>$customer]);
    }

    public function update(Request $request, $id){
        $customer = Customer::findorfail($id);
        $customer->active_status = 1; // set to Paid
        $customer->save();

        return redirect()->route('admin')->with('success', 'Customer activated successfully!');
    }

    public function deactivate(Request $request, $id){
        $customer = Customer::findorfail($id);
        $customer->active_status = 0; // set to Paid
        $customer->save();

        return redirect()->route('admin')->with('success', 'Customer deactivated successfully!');
    }

    public function destroy(Request $request, $id){
        $customer = Customer::findorfail($id);
        $customer->delete();
        return redirect()->route('admin')->with('removed', 'Customer deleted successfully!');
    }

    public function homeSettings(Request $request)
    {
        // Check if the logged in user is an admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->route('matrimony');
        }

        return view('settings.home', [
            'adminsettings' => Setting::orderBy('id', 'DESC')->get(),
            'setting'       => null // for new form (blank)
        ]);
    }

    public function homeSettingsSave(Request $request){
        $request->validate([
            'display_text' => 'required|string|max:255',
            'event_date'   => 'required|date',
        ]);
        
        Setting::create([
            'display_text' => $request->display_text,
            'event_date'   => $request->event_date,
        ]);

        return redirect()->route('settings.home')->with('success', 'Settings saved successfully!');
    }
    
    public function homeSettingsUpdate(Request $request, $id)
    {
        // Check if the logged in user is an admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->route('matrimony');
        }

        $request->validate([
            'display_text' => 'required|string|max:255',
            'event_date'   => 'required|date',
        ]);

        $setting = Setting::findOrFail($id);

        $setting->update([
            'display_text' => $request->display_text,
            'event_date'   => $request->event_date,
        ]);

        return redirect()->route('settings.home')->with('success', 'Settings updated successfully!');
    }


    public function homeSettingsEdit(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        return view('settings.home', [
            'adminsettings' => Setting::orderBy('id', 'DESC')->get(),
            'setting'       => $setting // for edit form
        ]);
    }
    
    public function homeSettingsDelete(Request $request, $id)
    {
        // Check if the logged in user is an admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->route('matrimony');
        }

        $setting = Setting::findOrFail($id);
        $setting->delete();

        return redirect()->route('settings.home')->with('success', 'Setting deleted successfully!');
    }

}
