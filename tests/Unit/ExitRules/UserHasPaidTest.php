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
        $ticket = factory('App\Ticket')->create([
            'user_id' => $user->id,
            'exited_at' => null,
            'paid_at' => now(),
        ]);
        $rule = new UserHasPaid($user);

        $this->assertTrue($rule->confirm());
    }

    /** @test */
    public function user_has_paid_rule_does_not_confirm()
    {
        $user = factory('App\User')->create();
        $ticket = factory('App\Ticket')->create([
            'user_id' => $user->id,
            'exited_at' => null,
            'paid_at' => null,
        ]);
        $rule = new UserHasPaid($user);

        $this->assertFalse($rule->confirm());
    }
}
