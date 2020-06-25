<?php


namespace App\Filters;

use App\Models\User;

class ThreadFilters extends Filters
{

    protected $filters = ['by', 'popular'];

    /**
     * Filter the query by username.
     *
     * @param string $username
     * @return mixed
     */
    protected function by(string $username)
    {
        $user = User::whereName($username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }

    /**
     * @param string $username
     * @return mixed
     */
    protected function popular(string $username)
    {
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('replies_count', 'desc');
    }


}
