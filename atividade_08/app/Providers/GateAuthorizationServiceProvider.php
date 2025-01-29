<?php

namespace App\Providers;

use App\Enums\UserRolesEnum;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use App\Policies\AuthorPolicy;
use App\Policies\BookPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PublisherPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class GateAuthorizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Book::class, BookPolicy::class);
        Gate::policy(Publisher::class, PublisherPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Author::class, AuthorPolicy::class);
        Gate::define('edit_users_roles', function (User $user) {
            return $user->role === UserRolesEnum::ADMIN->value ? Response::allow() :
                Response::deny('Você não pode realizar esta ação');
        });
    }
}
