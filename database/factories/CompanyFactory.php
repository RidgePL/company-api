<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            Company::FIELD_NAME => $this->faker->company,
            Company::FIELD_ADDRESS => $this->faker->streetAddress,
            Company::FIELD_CITY => $this->faker->city,
            Company::FIELD_POSTCODE => $this->faker->postcode,
            Company::FIELD_VAT_NUMBER => $this->faker->iban, //Iban is similar to nip - it doesn't matter for the test data
        ];
    }
}
