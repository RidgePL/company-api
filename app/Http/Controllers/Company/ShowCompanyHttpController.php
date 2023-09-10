<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Responses\Resources\Company\Company;
use App\Interfaces\ShowsCompany;
use App\Models\Company as CompanyModel;
use Illuminate\Http\JsonResponse;

class ShowCompanyHttpController extends Controller
{
    public function __construct(private readonly ShowsCompany $showsCompany)
    {
    }

    /**
     * @OA\Get(
     *     path="/company/{companyId}",
     *     summary="Show details for a specific company",
     *     tags={"Company"},
     *     @OA\Parameter(
     *         name="companyId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully showed the company details",
     *         @OA\JsonContent(ref="#/components/schemas/Company")
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
    public function __invoke(CompanyModel $company): JsonResponse
    {
        return Company::make($this->showsCompany->showModel($company))->response();
    }
}
