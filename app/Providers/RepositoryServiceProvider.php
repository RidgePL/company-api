<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\CreatesCompany;
use App\Interfaces\CreatesEmployee;
use App\Interfaces\DeletesCompany;
use App\Interfaces\DeletesEmployee;
use App\Interfaces\ListsCompanies;
use App\Interfaces\ListsCompanyEmployees;
use App\Interfaces\ListsEmployees;
use App\Interfaces\ShowsCompany;
use App\Interfaces\ShowsEmployee;
use App\Interfaces\UpdatesCompany;
use App\Interfaces\UpdatesEmployee;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ListsCompanies::class => CompanyRepository::class,
        CreatesCompany::class => CompanyRepository::class,
        ShowsCompany::class => CompanyRepository::class,
        UpdatesCompany::class => CompanyRepository::class,
        DeletesCompany::class => CompanyRepository::class,
        ListsCompanyEmployees::class => EmployeeRepository::class,
        ListsEmployees::class => EmployeeRepository::class,
        CreatesEmployee::class => EmployeeRepository::class,
        ShowsEmployee::class => EmployeeRepository::class,
        DeletesEmployee::class => EmployeeRepository::class,
        UpdatesEmployee::class => EmployeeRepository::class,
    ];
}
