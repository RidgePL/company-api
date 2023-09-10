<?php

declare(strict_types=1);

namespace App\Http\Responses\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Company as CompanyModel;

/**
 * @OA\Schema(
 *     schema="CompanyList",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="vat_number",
 *         type="string"
 *     ),
 *     required={"id", "name", "vat_number"}
 * )
 */

class CompanyList extends JsonResource
{
    //Just an assumption that list doesn't need all fields of a company
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{CompanyModel::FIELD_ID},
            'name' => $this->{CompanyModel::FIELD_NAME},
            'vat_number' => $this->{CompanyModel::FIELD_VAT_NUMBER},
        ];
    }
}
