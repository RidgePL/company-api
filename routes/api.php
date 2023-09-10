<?php

use App\Http\Controllers\Company\CreateCompanyHttpController;
use App\Http\Controllers\Company\DeleteCompanyHttpController;
use App\Http\Controllers\Company\ListCompanyHttpController;
use App\Http\Controllers\Company\ShowCompanyHttpController;
use App\Http\Controllers\Company\UpdateCompanyHttpController;
use App\Http\Controllers\Employees\CreateEmployeeHttpController;
use App\Http\Controllers\Employees\DeleteEmployeeHttpController;
use App\Http\Controllers\Employees\ListCompanyEmployeesHttpController;
use App\Http\Controllers\Employees\ListEmployeesHttpController;
use App\Http\Controllers\Employees\ShowEmployeeHttpController;
use App\Http\Controllers\Employees\UpdateEmployeeHttpController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'as' => 'company',
    'prefix' => 'company',
], function (Router $router) {

    $router->group([
        'as' => '.employees',
        'prefix' => '/{company}/employees',
    ], function (Router $router) {
        $router->get('/', ListCompanyEmployeesHttpController::class)->name('.list');
        $router->post('/', CreateEmployeeHttpController::class)->name('.create');
    });

    $router->get('/{company}', ShowCompanyHttpController::class)->name('.show');
    $router->put('/{company}', UpdateCompanyHttpController::class)->name('.update');
    $router->delete('/{company}', DeleteCompanyHttpController::class)->name('.delete');
    $router->get('/', ListCompanyHttpController::class)->name('.list');
    $router->post('/', CreateCompanyHttpController::class)->name('.create');
});

Route::group([
    'as' => 'employee',
    'prefix' => 'employee',
], function (Router $router) {
    $router->get('/{employee}', ShowEmployeeHttpController::class)->name('.show');
    $router->delete('/{employee}', DeleteEmployeeHttpController::class)->name('.delete');
    $router->put('/{employee}', UpdateEmployeeHttpController::class)->name('.delete');
    $router->get('/', ListEmployeesHttpController::class)->name('.list');
});
