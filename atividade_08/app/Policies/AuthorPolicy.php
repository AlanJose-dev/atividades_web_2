<?php

namespace App\Policies;

use App\Enums\UserRolesEnum;
use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    private static string $denyMessage = 'Você não pode realizar esta ação';

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Author $author): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return in_array($user->role, [UserRolesEnum::ADMIN->value, UserRolesEnum::LIBRARIAN->value])
            ? Response::allow() : Response::deny(self::$denyMessage);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Author $author): Response
    {
        return $this->create($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Author $author): Response
    {
        return $this->create($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Author $author): Response
    {
        return $this->create($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Author $author): Response
    {
        return $this->create($user);
    }
}
