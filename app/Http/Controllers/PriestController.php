<?php

namespace App\Http\Controllers;

use App\Models\Priest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PriestController extends Controller
{
    /**
     * Display the priest page with dynamic data
     */
    public function index()
    {
        $priests = Priest::getRecentPriests();
        $currentPriest = Priest::getCurrentPriest();

        return view('shrine.priest', compact('priests', 'currentPriest'));
    }

    /**
     * Store a new priest (Admin only)
     */
    public function store(Request $request)
    {
        // Check if user is admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'father_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'from_year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'to_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10) . '|gte:from_year',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096' // 10MB max
        ]);

        try {
            $image = $request->file('image');

            // Create directory if it doesn't exist
            $directory = 'priest_images';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Generate unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs($directory, $filename, 'public');

            // Create priest record
            $priest = Priest::create([
                'father_name' => $request->father_name,
                'designation' => $request->designation,
                'from_year' => $request->from_year,
                'to_year' => $request->to_year,
                'image_path' => $imagePath,
                'original_name' => $image->getClientOriginalName(),
                'image_type' => $image->getMimeType(),
                'file_size' => $image->getSize()
            ]);

            return redirect()->back()->with('success', 'Priest added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add priest: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing priest (Admin only)
     */
    public function update(Request $request, $id)
    {
        // Check if user is admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $priest = Priest::findOrFail($id);

        $request->validate([
            'father_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'from_year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'to_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10) . '|gte:from_year',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        try {
            $updateData = [
                'father_name' => $request->father_name,
                'designation' => $request->designation,
                'from_year' => $request->from_year,
                'to_year' => $request->to_year,
            ];

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete old image
                if ($priest->image_path && Storage::exists($priest->image_path)) {
                    Storage::delete($priest->image_path);
                }

                $image = $request->file('image');

                // Create directory if it doesn't exist
                $directory = 'priest_images';


                // Generate unique filename
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs($directory, $filename, 'public');


                $updateData['image_path'] = $imagePath;
                $updateData['original_name'] = $image->getClientOriginalName();
                $updateData['image_type'] = $image->getMimeType();
                $updateData['file_size'] = $image->getSize();
            }

            $priest->update($updateData);

            return redirect()->back()->with('success', 'Priest updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update priest: ' . $e->getMessage());
        }
    }

    /**
     * Delete a priest (Admin only)
     */
    public function destroy($id)
    {
        // Check if user is admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        try {
            $priest = Priest::findOrFail($id);

            // Delete image file
            if ($priest->image_path && Storage::exists($priest->image_path)) {
                Storage::delete($priest->image_path);
            }

            $priest->delete();

            return redirect()->back()->with('success', 'Priest deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete priest: ' . $e->getMessage());
        }
    }

    /**
     * Get priest data for editing (Admin only)
     */
    public function edit($id)
    {
        // Check if user is admin
        $admin = auth('customer')->user();
        if (!$admin || $admin->is_admin !== 'yes') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $priest = Priest::findOrFail($id);
        $priests = Priest::getRecentPriests();
        $currentPriest = Priest::getCurrentPriest();

        return view('shrine.priest', compact('priests', 'currentPriest', 'priest'));
    }
}
