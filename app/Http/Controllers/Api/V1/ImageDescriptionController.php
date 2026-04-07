<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\OpenRouterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateDescriptionRequest;
use App\Models\imageDescription;

class ImageDescriptionController extends Controller
{   
    public function __construct(private OpenRouterService $openRouterService)
    { 
    }
    public function index()
    {
        // Logic to retrieve and return image descriptions
    }

    public function store(GenerateDescriptionRequest $request)
    {
        $image = $request->file('image');

        $originalFilename = $image->getClientOriginalName();
        $sanitizedFilename = pathinfo($originalFilename, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $safeFilename = $sanitizedFilename . '_' . time() . '.' . $extension;
        $fileSize = $image->getSize();
        $mimeType = $image->getMimeType();

        $imagePath = $image->storeAs('public/image_descriptions', $safeFilename);
        

        $generatedDescription = $this->openRouterService->generateDescriptionFromImage($image);
        
        $imageDescription = imageDescription::create([
            'user_id' => 7,
            'image_path' => $imagePath,
            'generated_description' => $generatedDescription,
            'original_filename' => $originalFilename,
            'file_size' => $fileSize,
            'mime_type' => $mimeType
        ]);

        return response()->json([
            'message' => 'Image description generated successfully',
            'data' => $generatedDescription  // 'data' => $imageDescription
        ], 201);
    }
}
