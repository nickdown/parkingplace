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

        $this->assertFalse($user->garage()->inside());
    }

    /** @test */
    public function a_user_can_report_they_are_in_the_garage()
    {
        $user = factory('App\User')->create();

        $user->garage()->enter();

        $this->assertTrue($user->garage()->inside());
    }

    /** @test */
    public function a_multiple_time_user_is_not_in_the_garage()
    {
        $user = factory('App\User')->create();
        $tickets = factory('App\Ticket', 3)->create([
            'user_id' => $user->id
        ]);
        
        $this->assertFalse($user->garage()->inside());
    }

    /** @test */
    public function a_multiple_time_user_is_in_the_garage()
    {
        $user = factory('App\User')->create();
        $tickets = factory('App\Ticket', 3)->create([
            'user_id' => $user->id
        ]);

        $user->garage()->enter();

        $this->assertTrue($user->garage()->inside());
    }
}
