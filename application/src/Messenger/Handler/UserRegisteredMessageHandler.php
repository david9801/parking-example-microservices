<?php

namespace App\Messenger\Handler;

use App\Entity\User;
use App\Messenger\Message\UserRegisteredMessage;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;

class UserRegisteredMessageHandler
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(UserRegisteredMessage $message): void
    {
        $user = new User($message->getName(), $message->getSurname(), $message->getEmail(), $message->getPassword());
        try {
            $this->userRepository->save($user);
        } catch (Exception $e) {
            throw new UnrecoverableMessageHandlingException('Could not save user: '. $e->getMessage());
        }
    }
}