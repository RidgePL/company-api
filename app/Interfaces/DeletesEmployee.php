<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Employee;

interface DeletesEmployee
{
    public function deleteForModel(Employee $employee): void;
}
