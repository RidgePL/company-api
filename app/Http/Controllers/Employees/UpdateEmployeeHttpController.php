<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Responses\Resources\Employee\Employee;
use App\Interfaces\UpdatesEmployee;
use App\Models\Employee as EmployeeModel;
use Illuminate\Http\JsonResponse;

class UpdateEmployeeHttpController extends Controller
{
    public function __construct(private readonly UpdatesEmployee $updatesEmployee)
    {
    }

    /**
     * @OA\Put(
     *     path="/employee/{employeeId}",
     *     summary="Update an employee",
     *     tags={"Employee"},
     *     @OA\Parameter(
     *         name="employeeId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UpdateEmployeeRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully updated the employee",
     *         @OA\JsonContent(ref="#/components/schemas/Employee")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Employee not found"
     *     )
     * )
     */
    public function __invoke(EmployeeModel $employee, UpdateEmployeeRequest $request): JsonResponse
    {
        $employee = $this->updatesEmployee->update($employee, $request->toPayload());
        if ($request->validated('company_id')) {
            $employee = $this->updatesEmployee->assignToCompany($employee, $request->validated('company_id'));
        }

        return Employee::make($employee)->response();
    }
}
