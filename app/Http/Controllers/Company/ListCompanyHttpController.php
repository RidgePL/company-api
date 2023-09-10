<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Responses\Resources\Company\CompanyList;
use App\Interfaces\ListsCompanies;
use Illuminate\Http\JsonResponse;

class ListCompanyHttpController extends Controller
{
    public function __construct(private readonly ListsCompanies $listsCompanies)
    {
    }

    /**
     * @OA\Get(
     *     path="/companies",
     *     summary="List all companies",
     *     tags={"Company"},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully listed the companies",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CompanyList")
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
        return CompanyList::collection($this->listsCompanies->get())
            ->response();
    }
}
