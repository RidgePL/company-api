<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ListsEmployees
{
    public function get(): Collection;
}
