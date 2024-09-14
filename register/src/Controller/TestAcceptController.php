<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TestAcceptController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['ok' => true], Response::HTTP_OK);
    }
}