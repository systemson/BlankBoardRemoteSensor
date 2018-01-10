<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\Traits\BeforePolicyTraits;
use App\Policies\Traits\ActionPolicyTraits;

class InvoicePolicy
{
    use HandlesAuthorization,
        BeforePolicyTraits,
        ActionPolicyTraits;

    /**
     * The permission name.
     *
     * @var string
     */
    private $name = 'users';

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermission('create_' . $this->name) || $user->hasRole('ventanilla')) {
            return true;
        }

        return abort(403, __('messages.access-denied'));
    }
}
