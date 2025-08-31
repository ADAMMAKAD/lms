<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TinymceImageUploadController extends Controller {
    public function upload(Request $request) {
        // Implement stricter file size limits and additional security checks
        $validator = Validator::make($request->all(), [
            'file' => [
                'required',
                'image',
                'max:5120', // Reduced from 10MB to 5MB
                'mimes:jpeg,jpg,png,gif,webp',
                'dimensions:max_width=4096,max_height=4096,min_width=10,min_height=10'
            ],
        ], [
            'file.required' => __('The image is required and must be an image file with a maximum size of 5120 kilobytes (5 MB).'),
            'file.image'    => __('The image must be an image file with a maximum size of 5120 kilobytes (5 MB).'),
            'file.max'      => __('The image must be an image file with a maximum size of 5120 kilobytes (5 MB).'),
            'file.mimes'    => __('The image must be a file of type: jpeg, jpg, png, gif, webp.'),
            'file.dimensions' => __('The image dimensions must be between 10x10 and 4096x4096 pixels.'),
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Upload the image using the file_upload helper function
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $url = file_upload($file, 'uploads/forum-images/');

            return response()->json(['location' => asset($url)]);
        }

        return response()->json(['error' => __('Image upload failed')], 422);
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'file_path' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid file path'], 400);
        }

        $file_path = $request->input('file_path');
        
        // Extract only the uploads path using regex
        if (!preg_match('/\/uploads\/forum-images\/[a-zA-Z0-9_\-\.]+\.(jpg|jpeg|png|gif|webp)$/i', $file_path, $matches)) {
            return response()->json(['error' => 'Invalid file path format'], 400);
        }
        
        // Extract the relative path from the full URL
        $image_path = preg_replace('/^.*\/(uploads\/forum-images\/.*)$/', '$1', $file_path);
        
        // Normalize the path to prevent directory traversal
        $image_path = str_replace(['../', '..\\', '\0'], '', $image_path);
        
        // Ensure the path starts with uploads/forum-images/
        if (!str_starts_with($image_path, 'uploads/forum-images/')) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        $fullPath = public_path($image_path);
        
        // Additional security check: ensure the resolved path is within the allowed directory
        $allowedDir = public_path('uploads/forum-images/');
        $realPath = realpath($fullPath);
        $realAllowedDir = realpath($allowedDir);
        
        if (!$realPath || !str_starts_with($realPath, $realAllowedDir)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        if (File::exists($fullPath)) {
            File::delete($fullPath);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['error' => 'File not found'], 404);
    }
}
