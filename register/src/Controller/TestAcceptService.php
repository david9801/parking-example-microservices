<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class TestAcceptService
{
    /**
     *
     * #[Route('/v1/accept', methods: ['GET'], name: 'accept')]
     */
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['ok' => true], false);
    }
}