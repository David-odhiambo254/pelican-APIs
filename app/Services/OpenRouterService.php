<?php

namespace App\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class OpenRouterService
{
    public function generateDescriptionFromImage($imagePath)
    {
        $logger = new Logger('api_logger');
        $logger->pushHandler(new StreamHandler(storage_path('logs/api.log'), Logger::INFO));
        $apiKey = config('services.open_router.api_key');
        $model = config('services.open_router.model');

        // Logic to call Open Router API with the image and get the description
        $logger->info('Sending request to Open Router API');
        $response = request()->post('https://api.openrouter.ai/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $model,
                
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => [
                            'type' => 'text',
                            'text' => "What is in this image?",
                        ]
                    ],
                    [
                        'role' => 'user',
                        'content' => [
                            'type' => 'image',
                            'image_url' => $imagePath,
                        ]
                    ]
                ]
            ],
        ]);

        // Log the response
        $logger->info('API Response: ' . json_encode($response));

        if (is_string($response)) {
            $decoded = json_decode($response);
            $response = json_last_error() === JSON_ERROR_NONE ? $decoded : (object)['raw' => $response];
        } elseif (is_array($response)) {
            $response = (object) $response;
        } elseif ($response === null) {
            $response = (object) [];
        }

        // if ($response->failed()) {
        //     return 'Failed to generate description. Please try again later.';
        // }

        $data = $response ?? (object) [];
        // return $data->choices[0]->message->content ?? 'No description generated.';
        logger()->info('Extracted Data: ' . json_encode($data));
        return $response ?? 'No description generated.';
    }
}
