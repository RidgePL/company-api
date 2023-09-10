<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Employee;
use App\Payloads\EmployeePayload;

interface UpdatesEmployee
{
    //This could be merged into one function, but changing company is very rare so it's better to keep it separate.
    // It is to be considered if a separate interface shouldn't be made.
    public function update(Employee $employee, EmployeePayload $payload): Employee;

    public function assignToCompany(Employee $employee, int $companyId): Employee;
}
