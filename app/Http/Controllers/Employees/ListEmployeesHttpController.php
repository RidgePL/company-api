<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Responses\Resources\Employee\EmployeeList;
use App\Interfaces\ListsEmployees;
use Illuminate\Http\JsonResponse;

class ListEmployeesHttpController extends Controller
{
    public function __construct(private readonly ListsEmployees $listsEmployees)
    {
    }

    /**
     * @OA\Get(
     *     path="/employees",
     *     summary="List all employees",
     *     tags={"Employee"},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully listed the employees",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/EmployeeList")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function __invoke(): JsonResponse
    {
        return EmployeeList::collection(
            $this->listsEmployees->get()
        )->response();
    }
}
