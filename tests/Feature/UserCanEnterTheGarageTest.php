<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanEnterTheGarageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_is_allowed_to_enter_the_garage_by_default()
    {
        $user = factory('App\User')->create();
        
        $this->assertTrue($user->canEnterGarage());
    }

    /** @test */
    public function a_user_is_not_allowed_to_enter_the_garage_if_they_are_in_the_garage()
    {
        $user = factory('App\User')->create();

        $user->enterGarage();
        
        $this->assertFalse($user->canEnterGarage());
    }

    /** @test */
    public function a_user_cannot_enter_garage_if_they_are_already_in_the_garage()
    {
        $user = factory('App\User')->create();

        $user->enterGarage();
        
        try {
            $user->enterGarage();
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }
}
