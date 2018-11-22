<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrentTicketControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_a_current_ticket()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $ticket = factory('App\Ticket')->create(['user_id'=>$user->id, 'exited_at'=>null]);

        $this->actingAs($user)->json('GET', '/api/tickets/current')->assertOk();
    }

    /** @test */
    public function it_returns_null_if_there_is_no_current_ticket()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $ticket = factory('App\Ticket')->create(['user_id'=>$user->id]);

        $this->actingAs($user)->json('GET', '/api/tickets/current')->assertJson([
            'data' => null
        ]);
    }
}
