<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RecordPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param string $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->hasAnyRoles(['moder', 'admin'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Record $record)
    {
        return optional($user)->id === $record->user_id || $record->status == 'active';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Record $record)
    {
        return $user->id === $record->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Record $record)
    {
        return $user->id === $record->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Record $record)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Record $record)
    {
        //
    }
}
