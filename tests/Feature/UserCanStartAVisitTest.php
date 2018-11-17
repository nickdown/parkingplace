<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanStartAVisitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_start_a_visit()
    {
        $user = factory('App\User')->create();
        $this->assertSame(0, $user->visits()->count());

        $user->enterGarage();
        $user->refresh();

        $this->assertSame(1, $user->visits()->count());
    }
}
