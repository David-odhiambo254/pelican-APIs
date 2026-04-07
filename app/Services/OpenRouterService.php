<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use OpenAI\Factory;

class OpenRouterService
{
    public function generateDescriptionFromImage(UploadedFile $image) : string
    {
        $imageData = base64_encode(file_get_contents($image->getPathname()));
        $mimeType = $image->getMimeType();

         $client = (new Factory())->withApiKey(config('services.open_router.api_key'))->withBaseUri(config('services.open_router.base_url'))->withHttpHeader('HTTP-Referer', 'http://localhost:8000')->withHttpHeader('X-Title', 'My Laravel App (Local)')->make();
        // $client = (new Factory())->withApiKey(config('services.open_router.api_key'))->withBaseUri(config('services.open_router.base_url'))->make();
        $response = $client->chat()->create([
            'model' => config('services.open_router.model'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "You are a helpful assistant at an autopart store. Analyze the image and identify the vehicle part shown in the image. Where possible, provide the make, model, and year of the vehicle that uses thet part, part number, and estimated price of the part. Be concise and informative but brief in your description (5 sentences or less). If the image is not a vehicle part, please state that the image does not contain a recognizable vehicle part.",
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => 'data:' . $mimeType . ';base64,' . $imageData,
                            ]
                        ]
                    ]
                ],
            ]
        ]);

         // Log the response structure
        //  dd($response->choices[0]->message->content);
            $log = new Logger('open_router');
            $log->pushHandler(new StreamHandler(storage_path('logs/open_router.log')), Logger::INFO);
            $log->info('Open Router Response', ['response' => $response->choices[0]->message->content]);
        
        return $response->choices[0]->message->content ?? 'No description generated.';

    }
}
