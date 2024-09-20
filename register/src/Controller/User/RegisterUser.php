<?php

declare(strict_types = 1);

namespace App\Controller\User;

use App\Http\User\DTO\RegisterRequest;
use App\Service\User\RegisterUserService;
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
            $this->registerUserService->__invoke(
                $registerRequest->name(),
                $registerRequest->surname(),
                $registerRequest->email(),
                $registerRequest->password()
            );
            return new JsonResponse(['ok' => true]);
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