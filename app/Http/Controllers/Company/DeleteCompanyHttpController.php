<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Interfaces\DeletesCompany;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteCompanyHttpController extends Controller
{
    public function __construct(private readonly DeletesCompany $deletesCompany)
    {
    }

    /**
     * @OA\Delete(
     *     path="/company/{companyId}",
     *     summary="Delete a company",
     *     tags={"Company"},
     *     @OA\Parameter(
     *         name="companyId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successfully deleted the company"
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
        $this->deletesCompany->delete($company);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
