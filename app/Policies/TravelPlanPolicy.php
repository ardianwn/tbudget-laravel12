<?php

namespace App\Policies;

use App\Models\TravelPlan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TravelPlanPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TravelPlan $travelPlan)
    {
        return $user->id === $travelPlan->user_id;
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */

     public function update(User $user, TravelPlan $travelPlan)
     {
         return $user->id === $travelPlan->user_id;
     }

    /**
     * Determine whether the user can delete the model.
     */

     public function delete(User $user, TravelPlan $travelPlan)
     {
         return $user->id === $travelPlan->user_id;
     }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TravelPlan $travelPlan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TravelPlan $travelPlan): bool
    {
        return false;
    }
}
