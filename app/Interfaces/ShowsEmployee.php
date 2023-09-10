<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Employee;

interface ShowsEmployee
{
    public function show(Employee $employee): Employee;
}
