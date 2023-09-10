<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Responses\Resources\Company\Company;
use App\Interfaces\UpdatesCompany;
use App\Models\Company as CompanyModel;
use Illuminate\Http\JsonResponse;

class UpdateCompanyHttpController extends Controller
{
    public function __construct(private readonly UpdatesCompany $updatesCompany)
    {
    }

    /**
     * @OA\Put(
     *     path="/company/{companyId}",
     *     summary="Update an existing company",
     *     tags={"Company"},
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
     *             @OA\Schema(ref="#/components/schemas/UpdateCompanyRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully updated the company",
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
    public function __invoke(CompanyModel $company, UpdateCompanyRequest $request): JsonResponse
    {
        $company = $this->updatesCompany->updateModel($company, $request->toPayload());

        return Company::make($company)->response();
    }
}
