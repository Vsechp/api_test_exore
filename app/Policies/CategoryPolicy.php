<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return $user->role === 'manager';
    }

    public function update(User $user, Category $category)
    {
        return $user->role === 'manager';
    }

    public function delete(User $user, Category $category)
    {
        return $user->role === 'manager';
    }
}
