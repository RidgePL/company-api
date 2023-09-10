<?php

declare(strict_types=1);

namespace App\Http\Responses\Resources\Employee;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="EmployeeList",
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
 *     required={"id", "first_name", "last_name"}
 * )
 */
class EmployeeList extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{Employee::FIELD_ID},
            'first_name' => $this->{Employee::FIELD_FIRST_NAME},
            'last_name'  => $this->{Employee::FIELD_LAST_NAME},
        ];
    }
}
