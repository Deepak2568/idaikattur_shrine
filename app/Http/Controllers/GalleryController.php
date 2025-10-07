<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display the gallery page
     */
    public function index()
    {
        $folders = Gallery::getFolderNames();
        $galleryData = [];

        foreach ($folders as $folder) {
            $galleryData[$folder] = Gallery::getImagesByFolder($folder);
        }

        return view('shrine.gallery', compact('galleryData', 'folders'));
    }

    /**
     * Store a new image in gallery
     */
    public function store(Request $request)
    {
        // Check if user is admin
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'folder_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        try {
            $folderName = $request->folder_name;
            $image = $request->file('image');

            // Create directory if it doesn't exist
            $directory = 'gallery/' . $folderName;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Generate unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs($directory, $filename, 'public');

            // Store in database (allow multiple images per folder)
            Gallery::createImage(
                $folderName,
                $imagePath,
                $image->getClientOriginalName(),
                $image->getMimeType(),
                $image->getSize()
            );

            return redirect()->back()->with('success', 'Image uploaded successfully to folder: ' . $request->folder_name);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error uploading image: ' . $e->getMessage());
        }
    }

    /**
     * Delete an image from gallery
     */
    public function destroy($id)
    {
        // Check if user is admin
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        try {
            $gallery = Gallery::findOrFail($id);

            // Delete file from storage
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            // Delete from database
            $gallery->delete();

            return redirect()->back()->with('success', 'Image deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting image: ' . $e->getMessage());
        }
    }

    /**
     * Get images by folder (AJAX)
     */
    public function getImagesByFolder($folderName)
    {
        $images = Gallery::getImagesByFolder($folderName);
        return response()->json($images);
    }
}
