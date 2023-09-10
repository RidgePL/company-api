<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\CreatesCompany;
use App\Interfaces\DeletesCompany;
use App\Interfaces\ListsCompanies;
use App\Interfaces\ShowsCompany;
use App\Interfaces\UpdatesCompany;
use App\Models\Company;
use App\Payloads\CompanyPayload;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements ListsCompanies, CreatesCompany, ShowsCompany, UpdatesCompany, DeletesCompany
{
    public function get(): Collection
    {
        return Company::query()->get();
    }

    public function create(CompanyPayload $payload): Company
    {
        return Company::query()->create([
            Company::FIELD_NAME => $payload->getName(),
            Company::FIELD_ADDRESS => $payload->getAddress(),
            Company::FIELD_CITY => $payload->getCity(),
            Company::FIELD_POSTCODE => $payload->getPostcode(),
            Company::FIELD_VAT_NUMBER => $payload->getVatNumber(),
        ]);
    }

    public function showModel(Company $company): Company
    {
        return $company->load(Company::RELATION_EMPLOYEES);
    }

    public function updateModel(Company $company, CompanyPayload $payload): Company
    {
        $company->update([
            Company::FIELD_NAME => $payload->getName(),
            Company::FIELD_ADDRESS => $payload->getAddress(),
            Company::FIELD_CITY => $payload->getCity(),
            Company::FIELD_POSTCODE => $payload->getPostcode(),
            Company::FIELD_VAT_NUMBER => $payload->getVatNumber(),
        ]);

        return $company;
    }

    public function delete(Company $company): void
    {
        DB::transaction(function () use ($company) {
            $company->employees()->delete();
            $company->delete();
        });
    }
}
