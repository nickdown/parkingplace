<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\GateRaiseRequested;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_user_can_store_an_entry_to_the_garage()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        $this->assertDatabaseMissing('tickets', [
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->json('POST', '/api/entries');

        $this->assertDatabaseHas('tickets', [
            'user_id' => $user->id
        ]);
    }
    
    /** @test */
    public function a_user_already_in_the_garage_cannot_store_an_entry_to_the_garage()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        $user->garage()->enter();

        $this->actingAs($user)->json('POST', '/api/entries')->assertStatus(403);
    }

    /** @test */
    public function a_user_cant_enter_when_garage_is_full()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        config(['garage.spots' => 3]);

        $ticket = factory('App\Ticket', 3)->create([
            'exited_at' => null
        ]);

        $this->actingAs($user)->json('POST', '/api/entries')->assertStatus(403)->assertJsonStructure([
            'error'
        ]);
    }

    /** @test */
    public function a_successful_post_to_the_entry_controller_returns_the_current_ticket()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        //TODO: is there a way to test that the response is a TicketResource without being so specific?
        $this->actingAs($user)->json('POST', '/api/entries')->assertJsonStructure([
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
    public function a_successful_entry_request_dispatches_a_gate_raise_requested_event()
    {
        $this->withoutMiddleware();
        Event::fake();
        $user = factory('App\User')->create();

        $this->actingAs($user)->json('POST', '/api/entries');

        Event::assertDispatched(GateRaiseRequested::class);
    }

    /** @test */
    public function an_unsuccessful_entry_request_does_not_dispatch_a_gate_raise_requested_event()
    {
        $this->withoutMiddleware();
        Event::fake();
        $user = factory('App\User')->create();
        config(['garage.spots' => 0]);

        $this->actingAs($user)->json('POST', '/api/entries');

        Event::assertNotDispatched(GateRaiseRequested::class);
    }
}
