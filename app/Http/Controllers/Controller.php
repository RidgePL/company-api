<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenAPI(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Company API",
 *         description="API for managing employees and companies",
 *         @OA\Contact(
 *             email="krystianlata@wp.pl"
 *         )
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
