<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Assemblers\Company\CompanyAssembler;
use Tests\Assemblers\Employee\EmployeeAssembler;
use Tests\Assemblers\Employee\EmployeeListAssembler;
use Tests\TestCase;

class EmployeesHttpTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_company_employees(): void
    {
        $employeesCount = 10;
        $company = CompanyAssembler::assembleWithEmployees($employeesCount);

        $response = $this->get("/api/company/{$company->{Company::FIELD_ID}}/employees");
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'first_name',
                        'last_name',
                    ],
                ],
            ])->assertJsonCount($employeesCount, 'data');
    }

    public function test_it_lists_employees(): void
    {
        $employeesCount = 10;
        EmployeeListAssembler::assemble($employeesCount);

        $response = $this->get('/api/employee');
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'first_name',
                        'last_name',
                    ],
                ],
            ])->assertJsonCount($employeesCount, 'data');
    }

    public function test_it_creates_employee_for_company(): void
    {
        $company = CompanyAssembler::assembleWithoutEmployees();
        $employeeToCreate = Employee::factory()->make();
        $expectedEmployeesNumber = 1;

        $response = $this->post("/api/company/{$company->{Company::FIELD_ID}}/employees", $employeeToCreate->toArray());

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone'
                ],
            ]);
        $this->assertCount($expectedEmployeesNumber, $company->employees()->get());
        $this->assertDatabaseHas(Employee::class, $employeeToCreate->toArray());
    }

    public function test_it_shows_employee(): void
    {
        $employee = EmployeeAssembler::assemble();

        $response = $this->get("/api/employee/{$employee->{Employee::FIELD_ID}}");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'company' => [
                        'id',
                        'name',
                        'address',
                        'city',
                        'postcode',
                        'vat_number',
                    ],
                ],
            ]);
    }

    public function test_it_deletes_employee(): void
    {
        $employee = EmployeeAssembler::assemble();

        $response = $this->delete("/api/employee/{$employee->{Employee::FIELD_ID}}");

        $response->assertNoContent();
        $this->assertDatabaseMissing(Employee::class, $employee->toArray());
    }

    public function test_it_updates_basic_employee_data(): void
    {
        $employee = EmployeeAssembler::assemble();
        $employeeToUpdate = Employee::factory()->make();

        $response = $this->put("/api/employee/{$employee->{Employee::FIELD_ID}}", $employeeToUpdate->toArray());

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                ],
            ]);
        $this->assertDatabaseHas(Employee::class, $employeeToUpdate->toArray());
    }

    public function test_it_updates_employee_company(): void
    {
        $employee = EmployeeAssembler::assemble();
        $employeeDataForUpdate = Employee::factory()->make();
        $company = CompanyAssembler::assembleWithoutEmployees();

        $response = $this->put("/api/employee/{$employee->{Employee::FIELD_ID}}",
            array_merge($employeeDataForUpdate->toArray(), [
            'company_id' => $company->{Company::FIELD_ID},
        ]));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'company' => [
                        'id',
                        'name',
                        'address',
                        'city',
                        'postcode',
                        'vat_number',
                    ],
                ],
            ]);
        $this->assertDatabaseHas(Employee::class, [
            Employee::FIELD_ID => $employee->{Employee::FIELD_ID},
            Employee::FOREIGN_COMPANY_ID => $company->{Company::FIELD_ID},
        ]);
    }
}
