<?php

namespace App\Policies;

use App\Trip;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Trip $trip)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Trip $trip)
    {
        return $trip->user_id == $user->id;
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Trip $trip)
    {
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Trip $trip)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Trip $trip)
    {
        //
    }
}
