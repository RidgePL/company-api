<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Company;
use App\Models\Employee;
use App\Payloads\EmployeePayload;

interface CreatesEmployee
{
    public function createForModel(Company $company, EmployeePayload $payload): Employee;
}
