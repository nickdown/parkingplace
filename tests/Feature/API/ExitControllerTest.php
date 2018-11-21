<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExitControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_user_can_exit_the_garage_with_the_api()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();        
        $user->garage()->enter();
        $this->assertTrue($user->garage()->inside());

        $this->actingAs($user)->json('POST', '/api/exits');

        $this->assertFalse($user->garage()->inside());
    }
    
    /** @test */
    public function a_user_not_in_the_garage_cannot_exit_the_garage_with_the_api()
    {
        $this->withoutMiddleware();

        $user = factory('App\User')->create();

        $this->actingAs($user)->json('POST', '/api/exits')->assertStatus(403);
    }

}
