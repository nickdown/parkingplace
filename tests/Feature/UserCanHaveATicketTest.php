<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanHaveATicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_have_a_ticket()
    {
        $user = factory('App\User')->create();
        $ticket = factory('App\Ticket')->create([
            'user_id' => $user->id
        ]);

        $this->assertSame($user->tickets()->first()->id, $ticket->id);
    }

    /** @test */
    public function user_can_have_many_tickets()
    {
        $user = factory('App\User')->create();
        $ticket = factory('App\Ticket', 3)->create([
            'user_id' => $user->id
        ]);

        $this->assertSame(3, $user->tickets()->count());
    }
}
