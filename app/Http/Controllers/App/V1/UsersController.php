<?php

namespace App\Http\Controllers\App\V1;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepositoryInterface;
use App\Http\Controllers\App\ApiController;

class UsersController extends ApiController
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function store(UserStoreRequest $request)
    {
        return ($this->user->store($request))
            ? $this->sendResponse(200, true, __('messages.saved'))
            : $this->sendResponse(401, false, __('messages.not_saved'));
    }

    public function get()
    {
        $users = $this->user->get();
        return ($users)
            ? $this->sendResponse(200, true, '', $users)
            : $this->sendResponse(200, false, __('messages.not_available'));
    }
}
