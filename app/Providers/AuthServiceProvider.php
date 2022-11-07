<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Product;

use App\Models\Transaction;
use App\Policies\UserPolicy;
use App\Policies\BuyerPolicy;
use App\Policies\SellerPolicy;
use Laravel\Passport\Passport;
use App\Policies\ProductPolicy;
use App\Policies\TransactionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Buyer::class=>BuyerPolicy::class,
        Seller::class=>SellerPolicy::class,
        User::class=>UserPolicy::class,
        Transaction::class=>TransactionPolicy::class,
        Product::class=>ProductPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin-actions',function($user){
            return $user->is_admin();
        });
        
        Passport::ignoreRoutes();
        Passport::tokensExpireIn(now()->addMinutes(30));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    
    
        Passport::tokensCan([
            'purchase-product'=>'can create transaction for a specific product',
            'manage-products'=>'can update, insert, select and delete products (CRUD)',
            'manage-account'=>'read your account data, if admin(can modify account data)',
            'read-general'=>'read general information'
        ]);
    }
}