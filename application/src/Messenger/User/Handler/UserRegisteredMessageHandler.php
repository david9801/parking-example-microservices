<?php

namespace App\Messenger\User\Handler;

use App\Entity\User;
use App\Messenger\User\Message\UserRegisteredMessage;
use App\Repository\UserRepository;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

//#[AsMessageHandler]
class UserRegisteredMessageHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function __invoke(UserRegisteredMessage $message): void
    {
//        error_log('data ' . json_encode([
//                'name' => $message->getName(),
//                'surname' => $message->getSurname(),
//                'email' => $message->getEmail(),
//                'password' => $message->getPassword(),
//            ]));

        $user = new User(
            $message->getName(),
            $message->getSurname(),
            $message->getEmail(),
            $message->getPassword()
        );

        error_log('User created: ' . json_encode($user->toArray()));

        try {
            $this->userRepository->save($user);
        } catch (Exception $e) {
            error_log('❌ Error al guardar el usuario'. json_encode($e->getMessage()));
            throw new UnrecoverableMessageHandlingException('Could not save user: '. $e->getMessage());
        }
    }
}
