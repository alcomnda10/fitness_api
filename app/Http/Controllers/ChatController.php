<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        try {
            $response = Http::timeout(10)->post('https://gamalalzain.pythonanywhere.com/ask', [
                'question' => $request->question,
            ]);

            if (!$response->successful()) {
                Log::error('External API failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return response()->json(['error' => 'External API failed'], 502);
            }

            Log::info('External API response:', $response->json());

            return response()->json($response->json());
        } catch (\Throwable $e) {
            Log::error('Proxy ask exception', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error.'], 500);
        }
    }
}
