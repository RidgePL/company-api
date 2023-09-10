<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Responses\Resources\Employee\Employee;
use App\Interfaces\ShowsEmployee;
use App\Models\Employee as EmployeeModel;
use Illuminate\Http\JsonResponse;

class ShowEmployeeHttpController extends Controller
{
    public function __construct(private readonly ShowsEmployee $showsEmployee)
    {
    }

    /**
     * @OA\Get(
     *     path="/employee/{employeeId}",
     *     summary="Show details for a specific employee",
     *     tags={"Employee"},
     *     @OA\Parameter(
     *         name="employeeId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully showed the employee details",
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
    public function __invoke(EmployeeModel $employee): JsonResponse
    {
        return Employee::make($this->showsEmployee->show($employee))->response();
    }
}
