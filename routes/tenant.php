<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'auth',
])->group(function () {

    Route::get('/', function () {
        return 'Tenant ID: ' . tenant('id') . 
               ' | Domain: ' . tenant('domain');
    });

});