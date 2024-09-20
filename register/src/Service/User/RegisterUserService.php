<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Messenger\User\Message\UserRegisteredMessage;
use App\Messenger\User\RoutingKey;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class RegisterUserService
{
    public function __construct(public MessageBusInterface $bus)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function __invoke(string $name, ?string $surname, string $email, string $password): void
    {
        $data = new UserRegisteredMessage($name, $surname, $email, $password);
        $this->bus->dispatch(
            $data,
            [new AmqpStamp(RoutingKey::REGISTER_APPLICATION_QUEUE)]
        );
    }
}