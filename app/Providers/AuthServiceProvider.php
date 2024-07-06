<?php

namespace App\Providers;

use App\Models\Categorias;
use App\Policies\CategoriaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Permisos;
use App\Policies\PermisoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        Permisos::class => PermisoPolicy::class,
        Categorias::class => CategoriaPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }
}
