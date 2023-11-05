<?php

namespace App\Http\Controllers\admin\fileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminManageFileController extends Controller
{
    public function index()
    {
        try {
            $folderPaths = [
                'bg',
                'category',
                'faces',
                'logo',
                'products',
                'samples',
                'subcategory',
            ];

            $folders = [];

            // Extract folder names from folder paths
            foreach ($folderPaths as $path) {
                $folderName = basename($path);
                $folders[] = [
                    'name' => $folderName,
                    'path' => $path,
                ];
            }
            return view('backend.admin.file-manager.index', compact('folders'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function showImages($folder)
    {
        // Get the list of images in the specified folder
        try {

            $images = Storage::files('assets/images/' . $folder);

            return view('backend.admin.file-manager.show', compact('folder', 'images'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function uploadImages(Request $request, $folder)
    {
        try {
            // Validate the uploaded images
            $request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Store the uploaded images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Generate a unique name for the image
                    $imageName = uniqid(). '.' .$image->getClientOriginalExtension();
                    // Save the image to the desired folder
                    $image->storeAs('assets/images/' . $folder, $imageName);
                }
            }
            return back()->with('message', 'Images uploaded successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

}
