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
        $user = factory('App\User')->create();        
        $user->enterGarage();
        $this->assertTrue($user->isInGarage());

        $this->actingAs($user)->json('POST', '/exits');

        $this->assertFalse($user->isInGarage());
    }
    
    /** @test */
    public function a_user_not_in_the_garage_cannot_exit_the_garage_with_the_api()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)->json('POST', '/exits')->assertStatus(403);
    }

}
