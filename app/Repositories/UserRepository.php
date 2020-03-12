<?php
namespace App\Repositories;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Cache\Cache;

class UserRepository implements UserRepositoryInterface
{
    private $user;
    public $cache_users = 'cache_users';

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store($request)
    {
        cache()->forget($this->cache_users);
        return $this->user->create($request->all());
    }

    public function get()
    {
        return cache()->remember($this->cache_users, '', function() {
            return $this->user->get();
        });
    }
}
