<?php

namespace Tests\Unit\EntryRules;

use Tests\TestCase;
use App\Rules\EntryRules\GarageHasRoom;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GarageHasRoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function garage_has_room_rule_does_not_require_a_user_to_be_passed_in_constructor()
    {
        $user = factory('App\User')->create();
        
        $rule = new GarageHasRoom();

        $this->assertTrue($rule->confirm());
    }
}
