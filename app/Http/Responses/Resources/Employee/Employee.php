<?php

declare(strict_types=1);

namespace App\Http\Responses\Resources\Employee;

use App\Http\Responses\Resources\Company\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Employee as EmployeeModel;

class Employee extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="Employee",
     *     @OA\Property(
     *         property="id",
     *         type="integer"
     *     ),
     *     @OA\Property(
     *         property="first_name",
     *         type="string"
     *     ),
     *     @OA\Property(
     *         property="last_name",
     *         type="string"
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
     *     @OA\Property(
     *         property="company",
     *         ref="#/components/schemas/Company"
     *     ),
     *     required={"id", "first_name", "last_name", "email"}
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{EmployeeModel::FIELD_ID},
            'first_name' => $this->{EmployeeModel::FIELD_FIRST_NAME},
            'last_name' => $this->{EmployeeModel::FIELD_LAST_NAME},
            'email' => $this->{EmployeeModel::FIELD_EMAIL},
            'phone' => $this->{EmployeeModel::FIELD_PHONE},
            'company' => $this->whenLoaded(EmployeeModel::RELATION_COMPANY, fn () => Company::make($this->{EmployeeModel::RELATION_COMPANY})),
        ];
    }
}
