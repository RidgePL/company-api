<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Responses\Resources\Employee\Employee;
use App\Interfaces\CreatesEmployee;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CreateEmployeeHttpController extends Controller
{
    public function __construct(private readonly CreatesEmployee $createsEmployee)
    {
    }

    /**
     * @OA\Post(
     *     path="/company/{companyId}/employee",
     *     summary="Create a new employee for a specific company",
     *     tags={"Employee"},
     *     @OA\Parameter(
     *         name="companyId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CreateEmployeeRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successfully created the employee",
     *         @OA\JsonContent(ref="#/components/schemas/Employee")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found"
     *     )
     * )
     */
    public function __invoke(Company $company, CreateEmployeeRequest $request): JsonResponse
    {
        return Employee::make(
            $this->createsEmployee->createForModel($company, $request->toPayload())
        )->response();
    }
}
