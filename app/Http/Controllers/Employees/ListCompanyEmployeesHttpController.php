<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Responses\Resources\Employee\EmployeeList;
use App\Interfaces\ListsCompanyEmployees;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class ListCompanyEmployeesHttpController extends Controller
{
    public function __construct(private readonly ListsCompanyEmployees $listsCompanyEmployees)
    {
    }

    /**
     * @OA\Get(
     *     path="/company/{companyId}/employees",
     *     summary="List employees for a specific company",
     *     tags={"Employee"},
     *     @OA\Parameter(
     *         name="companyId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found"
     *     )
     * )
     */
    public function __invoke(Company $company): JsonResponse
    {
        return EmployeeList::collection(
            $this->listsCompanyEmployees->forModel($company)
        )->response();
    }
}
