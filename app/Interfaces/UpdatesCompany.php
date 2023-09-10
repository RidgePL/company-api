<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Company;
use App\Payloads\CompanyPayload;

interface UpdatesCompany
{
    public function updateModel(Company $company, CompanyPayload $payload): Company;
}
