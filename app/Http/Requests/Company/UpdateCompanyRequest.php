<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Payloads\CompanyPayload;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateCompanyRequest",
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="vat_number",
 *         type="string",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="address",
 *         type="string",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="city",
 *         type="string",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="postcode",
 *         type="string",
 *         maxLength=255
 *     ),
 *     required={"name", "vat_number", "address", "city", "postcode"}
 * )
 */

class UpdateCompanyRequest extends FormRequest
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
//Possibly this could be hidden in an abstract class, or a trait to not repeat it in every request
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
