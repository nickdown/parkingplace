<?php

namespace Tests\Unit\EntryRules;

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
        $rule = new UserNotInGarage($user);

        $this->assertTrue($rule->confirm());
    }

    /** @test */
    public function a_user_already_in_the_garage_will_not_pass_the_confirmation()
    {
        $user = factory('App\User')->create();
        $rule = new UserNotInGarage($user);

        $user->garage()->enter();

        $this->assertFalse($rule->confirm());
    }
}
