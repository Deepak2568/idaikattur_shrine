<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_name',
        'image_path',
        'original_name',
        'image_type',
        'file_size'
    ];

    /**
     * Get all unique folder names
     */
    public static function getFolderNames()
    {
        return self::select('folder_name')
            ->distinct()
            ->orderBy('folder_name')
            ->pluck('folder_name');
    }

    /**
     * Get images by folder name
     */
    public static function getImagesByFolder($folderName)
    {
        return self::where('folder_name', $folderName)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Create new image for a folder (allow multiple images per folder)
     */
    public static function createImage($folderName, $imagePath, $originalName = null, $imageType = null, $fileSize = null)
    {
        return self::create([
            'folder_name' => $folderName,
            'image_path' => $imagePath,
            'original_name' => $originalName,
            'image_type' => $imageType,
            'file_size' => $fileSize
        ]);
    }
}
