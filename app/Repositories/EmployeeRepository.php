<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\CreatesEmployee;
use App\Interfaces\DeletesEmployee;
use App\Interfaces\ListsCompanyEmployees;
use App\Interfaces\ListsEmployees;
use App\Interfaces\ShowsEmployee;
use App\Interfaces\UpdatesEmployee;
use App\Models\Company;
use App\Models\Employee;
use App\Payloads\EmployeePayload;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements ListsCompanyEmployees, ListsEmployees, CreatesEmployee, ShowsEmployee, DeletesEmployee, UpdatesEmployee
{
    public function forModel(Company $company): Collection
    {
        return $company->employees()->get();
    }

    public function get(): Collection
    {
        return Employee::query()->get();
    }

    public function createForModel(Company $company, EmployeePayload $payload): Employee
    {
        return $company->employees()->create([
            Employee::FIELD_FIRST_NAME => $payload->getFirstName(),
            Employee::FIELD_LAST_NAME => $payload->getLastName(),
            Employee::FIELD_EMAIL => $payload->getEmail(),
            Employee::FIELD_PHONE => $payload->getPhone(),
        ]);
    }

    public function show(Employee $employee): Employee
    {
        return $employee->load(Employee::RELATION_COMPANY);
    }

    public function deleteForModel(Employee $employee): void
    {
        $employee->delete();
    }

    public function update(Employee $employee, EmployeePayload $payload): Employee
    {
        $employee->update([
            Employee::FIELD_FIRST_NAME => $payload->getFirstName(),
            Employee::FIELD_LAST_NAME => $payload->getLastName(),
            Employee::FIELD_EMAIL => $payload->getEmail(),
            Employee::FIELD_PHONE => $payload->getPhone(),
        ]);

        return $employee;
    }

    public function assignToCompany(Employee $employee, int $companyId): Employee
    {
        $employee->company()->associate($companyId);
        $employee->save();
        $employee->load(Employee::RELATION_COMPANY);

        return $employee;
    }
}
