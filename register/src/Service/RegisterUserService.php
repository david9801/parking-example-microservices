<?php

declare(strict_types=1);

namespace App\Service;

use App\Messenger\Message\UserRegisteredMessage;
use App\Messenger\RoutingKey;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class RegisterUserService
{
    public function __construct(public MessageBusInterface $bus)
    {
    }

    public function __invoke(string $name, string $email)
    {
        $this->bus->dispatch(
            new UserRegisteredMessage($name, $email),
            [new AmqpStamp(RoutingKey::REGISTER_APPLICATION_QUE)]
        );
    }
}