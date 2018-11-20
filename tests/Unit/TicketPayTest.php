<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketPayTest extends TestCase
{
    use RefreshDatabase;

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
