<?php

namespace Tests\Unit;

use Exception;
use Tests\TestCase;
use App\EntryValidator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntryValidatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function entry_validator_confirms_user()
    {
        $user = factory('App\User')->create();

        $this->assertTrue(EntryValidator::confirm($user));
    }

    /** @test */
    public function entry_validator_throws_exception_if_a_rule_is_not_confirmed()
    {
        $this->expectException(Exception::class);
        $user = factory('App\User')->create();

        $user->enterGarage();
        
        //user will already be in garage, thus the NotInGarage entry rule will not confirm positively
        EntryValidator::confirm($user);
    }
}
