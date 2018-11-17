<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanVisitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_have_a_visit()
    {
        $user = factory('App\User')->create();
        $visit = factory('App\Visit')->create([
            'user_id' => $user->id
        ]);

        $this->assertSame($user->visits()->first()->id, $visit->id);
    }

    /** @test */
    public function user_can_have_many_visits()
    {
        $user = factory('App\User')->create();
        $visit = factory('App\Visit', 3)->create([
            'user_id' => $user->id
        ]);

        $this->assertSame(3, $user->visits()->count());
    }
}
