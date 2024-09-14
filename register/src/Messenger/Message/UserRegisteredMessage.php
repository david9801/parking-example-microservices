<?php

declare(strict_types=1);

namespace App\Messenger\Message;

class UserRegisteredMessage
{
    private ?string $name;
    private ?string $email;

    /**
     * @param string|null $name
     * @param string|null $email
     */
    public function __construct(?string $name, ?string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

}