<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserHasACurrentTicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_current_ticket()
    {
        $user = factory('App\User')->create();

        factory('App\Ticket', 2)->create([
            'user_id' => $user->id,
        ]);

        $ticket = $user->garage()->enter();

        $this->assertSame($ticket->id, $user->currentticket->id);
    }

    /** @test */
    public function a_user_with_no_ticket_returns_null_as_their_current_ticket()
    {
        $user = factory('App\User')->create();

        $this->assertSame(null, $user->currentticket);
    }

    /** @test */
    public function a_user_with_only_completed_tickets_returns_null_as_their_current_ticket()
    {
        $user = factory('App\User')->create();

        factory('App\Ticket', 2)->create([
            'user_id' => $user->id,
        ]);

        $this->assertSame(null, $user->currentticket);
    }
}
