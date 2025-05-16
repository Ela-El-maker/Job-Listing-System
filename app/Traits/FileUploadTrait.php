<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FileUploadTrait
{
    /**
     * Handle file uploads
     * **/
    function uploadFile(Request $request, string $inputName, ?string $oldPath = null, string $path = '/uploads'): string
    {
        if ($request->hasFile($inputName)) {
            try {
                $file = $request->file($inputName);

                // Sanitize filename
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $sanitizedName = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $originalName);
                $ext = $file->getClientOriginalExtension();
                $fileName = $sanitizedName . '_' . uniqid() . '.' . $ext;

                // Ensure upload directory exists
                $uploadPath = public_path($path);
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $file->move($uploadPath, $fileName);

                return $path . '/' . $fileName;
            } catch (\Exception $e) {
                // Log the error
                \Log::error('File upload failed: ' . $e->getMessage());
                return '';
            }
        }
        return '';
    }
}
