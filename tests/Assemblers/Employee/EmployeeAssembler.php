<?php

declare(strict_types=1);

namespace Tests\Assemblers\Employee;

use App\Models\Company;
use App\Models\Employee;

class EmployeeAssembler
{
    public static function assemble(): Employee
    {
        $company = Company::factory()->create();

        return $company->employees()->create(
            Employee::factory()->make()->toArray()
        );
    }
}
