<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            Employee::FIELD_FIRST_NAME => $this->faker->firstName,
            Employee::FIELD_LAST_NAME => $this->faker->lastName,
            Employee::FIELD_EMAIL => $this->faker->email,
            Employee::FIELD_PHONE => $this->faker->phoneNumber,
        ];
    }
}
