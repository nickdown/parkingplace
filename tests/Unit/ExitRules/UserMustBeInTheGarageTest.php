<?php

namespace Tests\Unit\ExitRules;

use Tests\TestCase;
use App\Rules\ExitRules\UserMustBeInTheGarage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserMustBeInTheGarageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_in_the_garage_will_pass_the_confirmation()
    {
        $user = factory('App\User')->create();
        $rule = new UserMustBeInTheGarage($user);

        $user->enterGarage();

        $this->assertTrue($rule->confirm());
    }

    /** @test */
    public function a_user_not_in_the_garage_will_fail_the_confirmation()
    {
        $user = factory('App\User')->create();
        $rule = new UserMustBeInTheGarage($user);

        $this->assertFalse($rule->confirm());
    }
}
