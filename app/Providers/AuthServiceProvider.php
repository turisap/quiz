<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // access to my quizzes page only for current user
        Gate::define('my_quizzes', function ($user, $id) {
            return $user->likes($id);
        });

        // show or not of the unlike button
        Gate::define('ableUnlike', function ($user, $quiz_id) {
            return $user->ableLike($quiz_id);
        });

        Gate::define('ableLike', function ($user, $quiz_id) {
            return $user->ableUnlike($quiz_id);
        });
    }
}
