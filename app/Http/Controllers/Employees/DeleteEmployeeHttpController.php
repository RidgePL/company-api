<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Interfaces\DeletesEmployee;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteEmployeeHttpController extends Controller
{
    public function __construct(private readonly DeletesEmployee $deletesEmployee)
    {
    }

    /**
     * @OA\Delete(
     *     path="/employee/{employeeId}",
     *     summary="Delete an employee",
     *     tags={"Employee"},
     *     @OA\Parameter(
     *         name="employeeId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successfully deleted the employee"
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
    public function __invoke(Employee $employee): JsonResponse
    {
        $this->deletesEmployee->deleteForModel($employee);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
