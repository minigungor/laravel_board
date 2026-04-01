<?php

namespace App\Commands\User\Auth\Register;

use App\Entity\User;
use App\Mail\Auth\VerifyMail;
use App\UserCases\Auth\RegisterService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Events\Dispatcher;

class Handler
{
    private $mailer;
    private $dispatcher;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(RegisterService $command): void
    {
        $user = User::register(
            $command->name,
            $command->email,
            $command->password
        );

        $this->mailer::to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }
}
