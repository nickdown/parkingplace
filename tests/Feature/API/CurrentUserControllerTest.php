<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrentUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_current_user_as_outside()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        $this->actingAs($user)->json('GET', '/api/users/current')->assertOk()->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'isInside' => false,
        ]);
    }

    /** @test */
    public function it_returns_the_current_user_as_inside()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $user->garage()->enter();

        $this->actingAs($user)->json('GET', '/api/users/current')->assertOk()->assertJsonFragment([
            'isInside' => true,
        ]);
    }

    /** @test */
    public function it_returns_the_current_user_with_their_current_ticket()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();
        $user->garage()->enter();

        $this->actingAs($user)->json('GET', '/api/users/current')->assertOk()->assertJsonStructure([
            'data' => [
                'currentTicket' => [],
            ]
        ]);
    }
}
