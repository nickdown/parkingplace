<?php

namespace Tests\Unit;

use Exception;
use Tests\TestCase;
use App\ExitValidator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExitValidatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function exit_validator_confirms_user()
    {
        $user = factory('App\User')->create();

        $user->enterGarage();

        $this->assertTrue(ExitValidator::confirm($user));
    }

    /** @test */
    public function exit_validator_throws_exception_if_a_rule_is_not_confirmed()
    {
        $this->expectException(Exception::class);

        $user = factory('App\User')->create();

        //user won't be in the garage, so the UserMustBeInTheGarage confirmation will fail and ExitValidator will throw an exception
        ExitValidator::confirm($user);
    }
}
