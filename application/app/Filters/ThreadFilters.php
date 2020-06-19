<?php


namespace App\Filters;

use App\Models\User;

class ThreadFilters extends Filters
{

    protected $filters = ['by'];

    /**
     * Filter the query by username.
     *
     * @param string $username
     * @return mixed
     */
    public function by(string $username)
    {
        $user = User::whereName($username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }


}
