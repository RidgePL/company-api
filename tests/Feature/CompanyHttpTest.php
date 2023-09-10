<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Assemblers\Company\CompanyAssembler;
use Tests\Assemblers\Company\CompanyListAssembler;
use Tests\TestCase;
//Other possible tests include - checking for 404, validation errors with wrong payload, etc.
//These are basic tests that show the idea and ensure that application is working as expected.
//Also, these tests are written before writing actual controller code.
class CompanyHttpTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_company(): void
    {
        $originalCount = 10;
        CompanyListAssembler::assemble($originalCount);
        $companyToCreate = Company::factory()->make();

        $response = $this->post('/api/company', $companyToCreate->toArray());

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'vat_number',
                ],
            ]);
        $this->assertDatabaseCount(Company::class, $originalCount + 1);
        $this->assertDatabaseHas(Company::class, $companyToCreate->toArray());
    }

    public function test_it_updates_company(): void
    {
        $company = CompanyAssembler::assembleWithoutEmployees();
        $companyToUpdate = Company::factory()->make();

        $response = $this->put("/api/company/{$company->{Company::FIELD_ID}}", $companyToUpdate->toArray());

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'vat_number',
                ],
            ]);
        $this->assertDatabaseCount(Company::class, 1);
        $this->assertDatabaseHas(Company::class, $companyToUpdate->toArray());
        $this->assertDatabaseMissing(Company::class, $company->toArray());
    }

    public function test_it_deletes_company_without_employees(): void
    {
        $company = CompanyAssembler::assembleWithoutEmployees();

        $response = $this->delete("/api/company/{$company->{Company::FIELD_ID}}");

        $response->assertNoContent();
        $this->assertDatabaseCount(Company::class, 0);
    }

    public function test_it_deletes_company_with_employees(): void
    {
        $employeesCount = 10;
        $company = CompanyAssembler::assembleWithEmployees($employeesCount);

        $response = $this->delete("/api/company/{$company->{Company::FIELD_ID}}");

        $response->assertNoContent();
        $this->assertDatabaseCount(Company::class, 0);
        $this->assertDatabaseMissing(Employee::class, [
            Employee::FOREIGN_COMPANY_ID => $company->{Company::FIELD_ID},
        ]);
    }

    public function test_it_lists_companies(): void
    {
        $listItemsCount = 10;
        CompanyListAssembler::assemble($listItemsCount);

        $this->get('/api/company')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'vat_number',
                    ],
                ],
            ])->assertJsonCount($listItemsCount, 'data');
    }

    public function test_it_shows_company_without_employees(): void
    {
        $company = CompanyAssembler::assembleWithoutEmployees();

        $this->get("/api/company/{$company->{Company::FIELD_ID}}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'vat_number',
                    'address',
                    'city',
                    'postcode',
                    'employees' => [],
                ],
            ]);
    }

    public function test_it_shows_company_with_employees(): void
    {
        $employeesCount = 10;
        $company = CompanyAssembler::assembleWithEmployees($employeesCount);

        $this->get("/api/company/{$company->{Company::FIELD_ID}}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'vat_number',
                    'address',
                    'city',
                    'postcode',
                    'employees' => [
                        '*' => [
                            'id',
                            'first_name',
                            'last_name',
                        ],
                    ],
                ],
            ]);
    }
}
