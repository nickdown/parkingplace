<?php

namespace Tests\Unit;

use Exception;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_ticket_cannot_have_a_null_entered_at_time()
    {
        $this->expectException(Exception::class);
        $ticket = factory('App\Ticket')->create([
            'entered_at' => null
        ]);
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

    /** @test */
    public function a_ticket_can_be_paid()
    {
        $ticket = factory('App\Ticket')->create([
            'paid_amount' => null,
            'paid_at' => null
        ]);

        $this->assertFalse($ticket->isPaid());
    }

    /** @test */
    public function a_ticket_can_be_unpaid()
    {
        $ticket = factory('App\Ticket')->create([
            'paid_amount' => 300,
            'paid_at' => now()
        ]);

        $this->assertTrue($ticket->isPaid());
    }
}
