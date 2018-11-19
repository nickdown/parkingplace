<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanReportIfTheyAreInTheGarageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_user_is_not_in_the_garage()
    {
        $user = factory('App\User')->create();

        $this->assertFalse($user->isInGarage());
    }

    /** @test */
    public function a_user_can_report_they_are_in_the_garage()
    {
        $user = factory('App\User')->create();

        $user->garage()->enter();

        $this->assertTrue($user->isInGarage());
    }

    /** @test */
    public function a_multiple_time_user_is_not_in_the_garage()
    {
        $user = factory('App\User')->create();
        $visits = factory('App\Visit', 3)->create([
            'user_id' => $user->id
        ]);
        
        $this->assertFalse($user->isInGarage());
    }

    /** @test */
    public function a_multiple_time_user_is_in_the_garage()
    {
        $user = factory('App\User')->create();
        $visits = factory('App\Visit', 3)->create([
            'user_id' => $user->id
        ]);

        $user->garage()->enter();

        $this->assertTrue($user->isInGarage());
    }
}
