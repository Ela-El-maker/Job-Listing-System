<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    //
    public function storeImage(Request $request)
    {
        try {
            // Validate the uploaded file
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            $file = $request->file('upload');

            // Generate a safe filename
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($originalName) . '_' . time() . '.' . $extension;

            // Ensure directory exists
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }

            // Move the file
            $file->move(public_path('uploads'), $filename);

            // Return the correct response format that CKEditor expects
            return response()->json([
                'uploaded' => true,  // Must be boolean true
                'url' => asset('uploads/' . $filename),
                'fileName' => $filename
            ]);
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());

            return response()->json([
                'uploaded' => false,
                'error' => [
                    'message' => 'Upload failed: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
