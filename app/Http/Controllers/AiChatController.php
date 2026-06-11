<?php

namespace App\Http\Controllers;

use App\Services\AiAssistantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AiChatController extends Controller
{
    public function __construct(private readonly AiAssistantService $assistant)
    {
    }

    /**
     * Handle chat message from the public assistant.
     *
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $reply = $this->assistant->respond($validated['message']);

        return response()->json([
            'reply' => $reply,
        ]);
    }
}
