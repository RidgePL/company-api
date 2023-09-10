<?php

declare(strict_types=1);

namespace App\Payloads;

class CompanyPayload
{
    public function __construct(
        private readonly string $name,
        private readonly string $address,
        private readonly string $city,
        private readonly string $postcode,
        private readonly string $vatNumber
    ) {}

    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
