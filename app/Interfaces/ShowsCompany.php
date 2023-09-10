<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Company;

interface ShowsCompany
{
    public function showModel(Company $company): Company;
}
