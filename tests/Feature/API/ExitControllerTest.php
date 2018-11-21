<?php

namespace Tests\Feature\API;

use Tests\TestCase;
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

        $this->actingAs($user)->json('POST', '/api/exits')->assertStatus(403);
    }
}
