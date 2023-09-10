<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Responses\Resources\Company\Company;
use App\Interfaces\CreatesCompany;
use Illuminate\Http\JsonResponse;

class CreateCompanyHttpController extends Controller
{
    public function __construct(private readonly CreatesCompany $createsCompany)
    {
    }

    /**
     * @OA\Post(
     *     path="/company",
     *     summary="Create a new company",
     *     tags={"Company"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CreateCompanyRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successfully created the company",
     *         @OA\JsonContent(ref="#/components/schemas/Company")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function __invoke(CreateCompanyRequest $request): JsonResponse
    {
        $company = $this->createsCompany->create($request->toPayload());

        return Company::make($company)->response();
    }
}
