<?php

namespace Tests\Unit\ExitRules;

use Tests\TestCase;
use App\Rules\ExitRules\UserHasPaid;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserHasPaidTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_has_paid_rule_confirms_true()
    {
        $user = factory('App\User')->create();
        $rule = new UserHasPaid($user);

        $this->assertTrue($rule->confirm());
    }
}
