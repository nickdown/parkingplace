<?php

namespace Tests\Unit\User;

use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanExitTheGarageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_exit_the_garage()
    {
        $user = factory('App\User')->create();
        
        $user->garage()->enter();
        $user->garage()->exit();

        $this->assertFalse($user->garage()->inside());
    }

    /** @test */
    public function a_user_not_in_the_garage_cannot_exit_the_garage()
    {
        $this->expectException(Exception::class);
        $user = factory('App\User')->create();

        $user->garage()->exit();
    }
}
