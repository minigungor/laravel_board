<?php

namespace App\UserCases\Auth;

use App\Entity\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Events\Dispatcher;

class RegisterService
{


    public function verify($id): void
    {
        /**@var User $user**/
        $user = User::findOrFail($id);
        $user->verify();
    }
}
