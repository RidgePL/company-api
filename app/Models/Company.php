<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    public const FIELD_ID = 'id';

    public const FIELD_NAME = 'name';
    public const FIELD_ADDRESS = 'address';
    public const FIELD_CITY = 'city';
    public const FIELD_POSTCODE = 'postcode';
    public const FIELD_VAT_NUMBER = 'vat_number';

    public const RELATION_EMPLOYEES = 'employees';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_ADDRESS,
        self::FIELD_CITY,
        self::FIELD_POSTCODE,
        self::FIELD_VAT_NUMBER,
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
