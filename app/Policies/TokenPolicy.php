<?php

namespace App\Policies;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class TokenPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PersonalAccessToken $personalAccessToken): bool
    {
        dd($user, $personalAccessToken);
        return $user->id === $personalAccessToken->tokenable_id;
    }
}
