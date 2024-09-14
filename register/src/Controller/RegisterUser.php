<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Http\DTO\RegisterRequest;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterUser
{
    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        try {
            return new JsonResponse(['name' => $registerRequest->name()]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}