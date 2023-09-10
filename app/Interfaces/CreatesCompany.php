<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Company;
use App\Payloads\CompanyPayload;

interface CreatesCompany
{
    public function create(CompanyPayload $payload): Company;
}
