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
    public function a_ticket_cannot_have_a_null_starting_at_time()
    {
        try {
            $ticket = factory('App\Ticket')->create([
                'starting_at' => null
            ]);
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function a_ticket_has_a_starting_at_time()
    {
        $ticket = factory('App\Ticket')->create();

        $this->assertInstanceOf(Carbon::class, $ticket->starting_at);
    }


    /** @test */
    public function a_ticket_can_have_a_null_ending_at_time()
    {
        $ticket = factory('App\Ticket')->create([
            'ending_at' => null
        ]);

        $this->assertNull($ticket->ending_at);
    }

    /** @test */
    public function a_ticket_can_have_an_ending_at_time()
    {
        $ticket = factory('App\Ticket')->create();

        $this->assertInstanceOf(Carbon::class, $ticket->ending_at);
    }
}
