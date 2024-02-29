<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {

        return $user->role === 'manager';
    }

    public function view(User $user, User $model)
    {
        return $user->id === $model->id || $user->role === 'manager';
    }

    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->role === 'manager';
    }

    public function delete(User $user, User $model)
    {

        return $user->role === 'manager';
    }
}
