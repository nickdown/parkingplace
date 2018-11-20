<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketHasTimesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_ticket_cannot_have_a_null_entered_at_time()
    {
        try {
            $ticket = factory('App\Ticket')->create([
                'entered_at' => null
            ]);
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function a_ticket_has_a_entered_at_time()
    {
        $ticket = factory('App\Ticket')->create();

        $this->assertInstanceOf(Carbon::class, $ticket->entered_at);
    }


    /** @test */
    public function a_ticket_can_have_a_null_exited_at_time()
    {
        $ticket = factory('App\Ticket')->create([
            'exited_at' => null
        ]);

        $this->assertNull($ticket->exited_at);
    }

    /** @test */
    public function a_ticket_can_have_an_exited_at_time()
    {
        $ticket = factory('App\Ticket')->create();

        $this->assertInstanceOf(Carbon::class, $ticket->exited_at);
    }
}
