<?php

namespace App\Policies;

use App\User;
use App\Statistics;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatisticsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the statistics.
     *
     * @param  \App\User  $user
     * @param  \App\Statistics  $statistics
     * @return mixed
     */
    public function view(User $user, Statistics $statistics)
    {
        //
    }

    /**
     * Determine whether the user can create statistics.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the statistics.
     *
     * @param  \App\User  $user
     * @param  \App\Statistics  $statistics
     * @return mixed
     */
    public function update(User $user, Statistics $statistics)
    {
        //
    }

    /**
     * Determine whether the user can delete the statistics.
     *
     * @param  \App\User  $user
     * @param  \App\Statistics  $statistics
     * @return mixed
     */
    public function delete(User $user, Statistics $statistics)
    {
        //
    }
}
