<?php

declare(strict_types = 1);

namespace App\Http\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest
{
    #[Assert\NotBlank(message: "The name cannot be blank.")]
    #[Assert\Length(
        min: 2,
        minMessage: "The name must be at least {{ limit }} characters long."
    )]
    private ?string $name;

    #[Assert\NotBlank(message: "The email cannot be blank.")]
    #[Assert\Email(message: "The email '{{ value }}' is not a valid email.")]
    private ?string $email;

    public function __construct(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

}