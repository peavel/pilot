<?php

namespace PEAVEL\Pilot\Tests;

use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    public function testSuccessfulLoginWithDefaultCredentials()
    {
        $this->visit(route('pilot.login'))
             ->type('admin@admin.com', 'email')
             ->type('password', 'password')
             ->press(__('pilot::generic.login'))
             ->seePageIs(route('pilot.dashboard'));
    }

    public function testShowAnErrorMessageWhenITryToLoginWithWrongCredentials()
    {
        session()->setPreviousUrl(route('pilot.login'));

        $this->visit(route('pilot.login'))
             ->type('john@Doe.com', 'email')
             ->type('pass', 'password')
             ->press(__('pilot::generic.login'))
             ->seePageIs(route('pilot.login'))
             ->see(__('auth.failed'))
             ->seeInField('email', 'john@Doe.com');
    }

    public function testRedirectIfLoggedIn()
    {
        Auth::loginUsingId(1);

        $this->visit(route('pilot.login'))
             ->seePageIs(route('pilot.dashboard'));
    }

    public function testRedirectIfNotLoggedIn()
    {
        $this->visit(route('pilot.profile'))
             ->seePageIs(route('pilot.login'));
    }

    public function testCanLogout()
    {
        Auth::loginUsingId(1);

        $this->visit(route('pilot.dashboard'))
             ->press(__('pilot::generic.logout'))
             ->seePageIs(route('pilot.login'));
    }

    public function testGetsLockedOutAfterFiveAttempts()
    {
        session()->setPreviousUrl(route('pilot.login'));

        for ($i = 0; $i <= 5; $i++) {
            $t = $this->visit(route('pilot.login'))
                 ->type('john@Doe.com', 'email')
                 ->type('pass', 'password')
                 ->press(__('pilot::generic.login'));
        }

        $t->see(__('auth.throttle', ['seconds' => 60]));
    }
}
