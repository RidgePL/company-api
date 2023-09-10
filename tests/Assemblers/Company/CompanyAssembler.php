<?php

declare(strict_types=1);

namespace Tests\Assemblers\Company;

use App\Models\Company;
use App\Models\Employee;

class CompanyAssembler
{
    public static function assembleWithoutEmployees(): Company
    {
        return Company::factory()->create();
    }

    public static function assembleWithEmployees(int $employeesCount): Company
    {
        $company = Company::factory()->create();
        $company->employees()->createMany(Employee::factory()->count($employeesCount)->make()->toArray());

        return $company;
    }
}
