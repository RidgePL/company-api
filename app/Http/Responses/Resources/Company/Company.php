<?php

declare(strict_types=1);

namespace App\Http\Responses\Resources\Company;

use App\Http\Responses\Resources\Employee\EmployeeList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Company as CompanyModel;

class Company extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="Company",
     *     @OA\Property(
     *         property="id",
     *         type="integer"
     *     ),
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
     *     @OA\Property(
     *         property="employees",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Employee")
     *     ),
     *     required={"id", "name", "address", "city", "postcode", "vat_number"}
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{CompanyModel::FIELD_ID},
            'name' => $this->{CompanyModel::FIELD_NAME},
            'address' => $this->{CompanyModel::FIELD_ADDRESS},
            'city' => $this->{CompanyModel::FIELD_CITY},
            'postcode' => $this->{CompanyModel::FIELD_POSTCODE},
            'vat_number' => $this->{CompanyModel::FIELD_VAT_NUMBER},
            'employees' => $this->whenLoaded(CompanyModel::RELATION_EMPLOYEES, fn () => EmployeeList::collection($this->{CompanyModel::RELATION_EMPLOYEES})),
        ];
    }
}
