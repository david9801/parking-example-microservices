<?php

declare(strict_types=1);

namespace App\Service;

use App\Messenger\Message\UserRegisteredMessage;
use App\Messenger\RoutingKey;
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
    public function __invoke(string $name, string $email): void
    {
        $data = new UserRegisteredMessage($name, $email);
        $this->bus->dispatch(
            $data,
            [new AmqpStamp(RoutingKey::REGISTER_APPLICATION_QUEUE)]
        );
    }
}