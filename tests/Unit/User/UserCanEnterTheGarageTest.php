<?php

namespace Tests\Unit\User;

use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanEnterTheGarageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_enter_the_garage()
    {
        $user = factory('App\User')->create();
        $this->assertSame(0, $user->tickets()->count());

        $user->garage()->enter();
        $user->refresh();

        $this->assertSame(1, $user->tickets()->count());
    }
}
