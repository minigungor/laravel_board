<?php

namespace Tests\Unit\Entity\User;

use App\Entity\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRegister(): void
    {
        $user = User::register(
            $name = 'name',
            $email = 'email',
            $password = 'password'
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);

        self::assertNotEmpty($user->password);
        self::assertEquals($password, $user->password);

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
    }

    public function testVerify(): void
    {
        $user = User::register('name', 'email', 'password');

        $user->verify();

        self::assertTrue($user->isActive());
        self::assertFalse($user->isWait());
    }

    public function testAlreadyVerified(): void
    {
        $user = User::register('name', 'email', 'password');

        $user->verify();

        $this->expectExceptionMessage('User is already verified.');
        $user->verify();
    }
}
