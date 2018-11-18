<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Rules\EntryRules\UserNotInGarage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserNotInGarageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_not_in_the_garage_will_pass_the_confirmation()
    {
        $user = factory('App\User')->create();
        $rule = new UserNotInGarage();

        $this->assertTrue($rule->confirm($user));
    }

    /** @test */
    public function a_user_already_in_the_garage_will_not_pass_the_confirmation()
    {
        $user = factory('App\User')->create();
        $rule = new UserNotInGarage();

        $user->enterGarage();

        $this->assertFalse($rule->confirm($user));
    }
}
