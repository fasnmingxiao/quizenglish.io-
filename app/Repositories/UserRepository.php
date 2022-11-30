<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;

class UserRepository
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function create($attributes)
    {
        return  $this->user->create($attributes);
    }
    public function get_reg_today()
    {
        return $this->user->whereDate('created_at', Carbon::today())->count();
    }
    public function updatePass($user)
    {
        return $user->save();
    }
    public function update($user)
    {
        return $user->save();
    }
    public function get($user_id)
    {
        return $this->user->find($user_id);
    }
    public function get_dashboard()
    {
        return $this->user->where('role', 2)->orderBy('created_at', 'desc')->limit(5)->get();
    }
}
