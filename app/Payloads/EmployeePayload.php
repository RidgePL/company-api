<?php

declare(strict_types=1);

namespace App\Payloads;

class EmployeePayload
{
    public function __construct(
        private readonly string  $first_name,
        private readonly string  $last_name,
        private readonly string  $email,
        private readonly ?string $phone,
    ) {
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
