<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Http\DTO\RegisterRequest;
use App\Service\RegisterUserService;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\ExceptionInterface;

class RegisterUser
{
    public function __construct(public RegisterUserService $registerUserService)
    {
    }

    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        try {
            $this->registerUserService->__invoke($registerRequest->name(), $registerRequest->email());
            return new JsonResponse(['name' => $registerRequest->name()]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (ExceptionInterface $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}