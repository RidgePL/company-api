<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface ListsCompanyEmployees
{
    public function forModel(Company $company): Collection;
}
