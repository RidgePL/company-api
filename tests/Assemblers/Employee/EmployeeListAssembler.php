<?php

declare(strict_types=1);

namespace Tests\Assemblers\Employee;

use Tests\Assemblers\Company\CompanyAssembler;

class EmployeeListAssembler
{
    public static function assemble(int $count): void
    {
        CompanyAssembler::assembleWithEmployees($count);
    }
}
