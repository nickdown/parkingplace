<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\GateRaiseRequested;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExitControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_not_in_the_garage_cannot_exit_the_garage_with_the_api()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        $this->actingAs($user)->json('POST', '/api/exits')->assertStatus(403);
    }

    /** @test */
    public function a_user_in_the_garage_who_paid_can_exit_the_garage_with_the_api()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();        
        $ticket = factory('App\Ticket')->create([
            'user_id' => $user->id,
            'exited_at' => null,
            'paid_at' => now(),
        ]);
        $this->assertTrue($user->garage()->inside());

        $this->actingAs($user)->json('POST', '/api/exits');

        $this->assertFalse($user->garage()->inside());
    }
    
    /** @test */
    public function a_user_in_the_garage_that_has_not_paid_cannot_exit_the_garage_with_the_api()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $ticket = factory('App\Ticket')->create([
            'user_id' => $user->id,
            'exited_at' => null,
            'paid_at' => null,
        ]);

        $this->actingAs($user)->json('POST', '/api/exits')->assertStatus(403)->assertJsonStructure([
            'error'
        ]);
    }

    /** @test */
    public function a_successful_post_to_the_exit_controller_returns_the_current_ticket()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $user->garage()->enter();
        
        $ticket = $user->currentTicket;
        $ticket->paid_at = now();
        $ticket->save();

        //TODO: is there a way to test that the response is a TicketResource without being so specific?
        $this->actingAs($user)->json('POST', '/api/exits')->assertJsonStructure([
            'data' => [
                'entered_at',
                'exited_at',
                'paid_at',
                'paid_amount',
                'isPaid',
                'rate',
            ]
        ]);
    }

    /** @test */
    public function a_successful_exit_request_dispatches_a_gate_raise_requested_event()
    {
        $this->withoutMiddleware();
        Event::fake();
        $user = factory('App\User')->create();
        $ticket = factory('App\Ticket')->create([
            'user_id' => $user->id,
            'exited_at' => null,
            'paid_at' => now(),
        ]);

        $this->actingAs($user)->json('POST', '/api/exits');

        Event::assertDispatched(GateRaiseRequested::class);
    }

    /** @test */
    public function an_unsuccessful_exit_request_does_not_dispatch_a_gate_raise_requested_event()
    {
        $this->withoutMiddleware();
        Event::fake();
        $user = factory('App\User')->create();
        $user->garage()->enter();

        $this->actingAs($user)->json('POST', '/api/exits');

        Event::assertNotDispatched(GateRaiseRequested::class);
    }
}
