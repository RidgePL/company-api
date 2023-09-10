<?php

declare(strict_types=1);

namespace Tests\Assemblers\Company;

use App\Models\Company;

//Just an idea showoff, in simple cases this could be overkill since Laravel factories can be used instead of assembler, but for more complicated cases this could be useful.
class CompanyListAssembler
{
    public static function assemble(int $count): void
    {
        Company::factory()->count($count)->create();
    }
}
