<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        
        Passport::cookie('api_token');

        Passport::enableImplicitGrant();
        
        Passport::tokensExpireIn(now()->addMonths(6));

        Passport::refreshTokensExpireIn(null); // Indefinitely

        Passport::personalAccessTokensExpireIn(null); // Indefinitely

        Passport::tokensCan([
            'read-calendar' => 'Czytać twój kalendarz',
            'add-events' => 'Dodawać wydarzenia do kalendarza',
            'change-and-remove-events' => 'Zmieniać i usuwać istniejące wydarzenia w kalendarzu',
        ]);
    }
}
