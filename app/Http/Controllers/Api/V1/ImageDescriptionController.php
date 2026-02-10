<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\OpenRouterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateDescriptionRequest;
use App\Models\imageDescription;

class ImageDescriptionController extends Controller
{
    protected $openRouterService;
    
    public function __construct(OpenRouterService $openRouterService)
    {
        $this->openRouterService = $openRouterService;
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
        // $description = $this->generateDescriptionFromImage($imagePath);

        $generatedDescription = $this->openRouterService->generateDescriptionFromImage($imagePath);
        
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
            'data' => $imageDescription
        ], 201);
    }
}
