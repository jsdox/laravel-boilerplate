<?php

namespace App\Observers;
use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
   public function creating(User $user)
   {
      $user->password = bcrypt($user->password);
      $user->api_token = Str::random(60);
      return $user;
   }
}