<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use App\Payloads\EmployeePayload;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateEmployeeRequest",
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         minLength=2,
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         minLength=2,
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         nullable=true
 *     ),
 *     required={"first_name", "last_name", "email"}
 * )
 */
class CreateEmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string'],
        ];
    }

    public function toPayload(): EmployeePayload
    {
        return new EmployeePayload(
            first_name: $this->validated('first_name'),
            last_name: $this->validated('last_name'),
            email: $this->validated('email'),
            phone: $this->validated('phone'),
        );
    }
}
