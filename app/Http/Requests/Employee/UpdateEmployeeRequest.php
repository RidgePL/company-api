<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use App\Payloads\EmployeePayload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
/**
 * @OA\Schema(
 *     schema="UpdateEmployeeRequest",
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         maxLength=255,
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="company_id",
 *         type="integer",
 *         nullable=true
 *     ),
 *     required={"first_name", "last_name", "email"}
 * )
 */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255'],
            'phone'      => ['nullable', 'string', 'max:255'],
            'company_id' => ['nullable', 'integer', Rule::exists('companies', 'id')],
        ];
    }

    public function toPayload(): EmployeePayload
    {
        return new EmployeePayload(
            $this->get('first_name'),
            $this->get('last_name'),
            $this->get('email'),
            $this->get('phone'),
        );
    }
}
