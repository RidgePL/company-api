<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Company;

interface DeletesCompany
{
    public function delete(Company $company): void;
}
