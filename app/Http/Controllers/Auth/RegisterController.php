<?php

namespace App\Http\Controllers\Auth;

use App\Commands\CommandBus;
use App\Commands\User\Auth\Register\Handler;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public $bus;
    public function __construct(CommandBus $bus)
    {
        $this->middleware('guest');
        $this->bus = $bus;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->bus->handle(new Handler::fromRequest($request));

        return redirect()->route('login')
            ->with('success', 'Check your email and click on the link to verify.');
    }

    public function verify($token)
    {
        if(!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Sorry your link cannot be identified.');
        }

        try {
            $this->bus->handle(new VerifyCommand($user->id));
            return redirect()->route('login')
                ->with('success', 'Your email is verified.Your account has been activated.');

        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }


    }
}
