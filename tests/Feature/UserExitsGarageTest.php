<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserExitsGarageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_exit_the_garage()
    {
        $user = factory('App\User')->create();
        
        $user->garage()->enter();
        $user->exitGarage();

        $this->assertFalse($user->isInGarage());
    }

    /** @test */
    public function a_user_not_in_the_garage_cannot_exit_the_garage()
    {
        $this->expectException(Exception::class);
        $user = factory('App\User')->create();

        $user->exitGarage();
    }
}
