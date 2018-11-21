<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrentUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_current_user()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        $this->actingAs($user)->json('GET', '/api/users/current')->assertOk()->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'isInside' => false,
            'hasPaid' => null,
        ]);
    }

    /** @test */
    public function it_returns_the_current_user_as_inside()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $user->garage()->enter();

        $this->actingAs($user)->json('GET', '/api/users/current')->assertOk()->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'isInside' => true,
            'hasPaid' => false,
        ]);
    }

    /** @test */
    public function it_returns_the_current_user_as_inside_and_paid()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $user->garage()->enter();
        
        $ticket = $user->currentTicket;
        $ticket->paid_at = now();
        $ticket->save();

        $this->actingAs($user)->json('GET', '/api/users/current')->assertOk()->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'isInside' => true,
            'hasPaid' => true,
        ]);
    }
}
