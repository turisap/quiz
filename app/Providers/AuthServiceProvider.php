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
            return $user->ableUnLike($quiz_id);
        });

        // can like a quiz (only on condition that it's not already liked)
        Gate::define('ableLike', function ($user, $quiz_id) {
            return $user->ablelike($quiz_id);
        });

        // checks whether a user tries to access it's own profile page and not another's
        Gate::define('my_profile', function ($user, $route_id) {
            return $user->ownsPage($route_id);
        });

        // checks whether a user is premium to access premium quizzes
        /*Gate::define('premium', function ($user){
            return $user->premium;
        });*/

        // checks whether a given teacher tries to access it's quizzes and not of another one
        Gate::define('isThisAuthor', function ($user, $route_id) {
             return $user->isThisAuthor($route_id);
        });

        // checks whether a given teacher tries to edit it's quiz and not another's
        Gate::define('my_created', function ($user, $author_id) {
             return $user->isCreatedByMe($author_id);
        });

        // allows a teacher to delete only it's own quizzes
        Gate::define('can_delete', function ($user, $author_id) {
            return $user->canDelete($author_id);
        });

    }
}
