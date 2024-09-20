<?php

declare(strict_types = 1);

namespace App\Http\User\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest
{
    #[Assert\NotBlank(message: "The name cannot be blank.")]
    #[Assert\Length(
        min: 2,
        minMessage: "The name must be at least {{ limit }} characters long."
    )]
    private string $name;

    #[Assert\Length(
        min: 2,
        minMessage: "The name must be at least {{ limit }} characters long."
    )]
    private ?string $surname;

    #[Assert\NotBlank(message: "The email cannot be blank.")]
    #[Assert\Email(message: "The email '{{ value }}' is not a valid email.")]
    private ?string $email;

    private string $password;

    public function __construct(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $this->name = $data['name'];
        $this->surname = $data['surname'] ?? null;
        $this->email = $data['email'];
        $this->password = password_hash($data['password'], PASSWORD_BCRYPT);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): ?string
    {
        return $this->surname;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}