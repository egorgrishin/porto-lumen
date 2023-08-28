<?php

namespace Sections\User\User\Observers;

use Core\Parents\BaseObserver;
use Illuminate\Support\Facades\Hash;
use Sections\User\User\Models\User;

class UserObserver extends BaseObserver
{
    /**
     * Handle the User "saving" event.
     */
    public function saving(User $user): void
    {
        if ($user->isDirty('password')) {
            $user->password = Hash::make($user->password);
        }
    }
}
