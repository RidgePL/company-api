<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Payloads\CompanyPayload;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateCompanyRequest",
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="address",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="city",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="postcode",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="vat_number",
 *         type="string"
 *     ),
 *     required={"name", "address", "city", "postcode", "vat_number"}
 * )
 */
class CreateCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'vat_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
        ];
    }

    public function toPayload(): CompanyPayload
    {
        return new CompanyPayload(
            name: $this->validated('name'),
            address: $this->validated('address'),
            city: $this->validated('city'),
            postcode: $this->validated('postcode'),
            vatNumber: $this->validated('vat_number'),
        );
    }
}
