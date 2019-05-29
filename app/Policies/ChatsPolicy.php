<?php

namespace App\Policies;

use App\User;
use App\Chats;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the chats.
     *
     * @param  \App\User  $user
     * @param  \App\Chats  $chats
     * @return mixed
     */
    public function view(User $user, Chats $chats)
    {
        //
    }

    /**
     * Determine whether the user can create chats.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the chats.
     *
     * @param  \App\User  $user
     * @param  \App\Chats  $chats
     * @return mixed
     */
    public function update(User $user, Chats $chats)
    {
        //
    }

    /**
     * Determine whether the user can delete the chats.
     *
     * @param  \App\User  $user
     * @param  \App\Chats  $chats
     * @return mixed
     */
    public function delete(User $user, Chats $chats)
    {
        //
    }
}
