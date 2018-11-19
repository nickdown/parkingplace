<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserHasACurrentVisitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_current_visit()
    {
        $user = factory('App\User')->create();

        factory('App\Visit', 2)->create([
            'user_id' => $user->id,
        ]);

        $visit = $user->enterGarage();

        $this->assertSame($visit->id, $user->currentVisit->id);
    }

    /** @test */
    public function a_user_with_no_visit_returns_null_as_their_current_visit()
    {
        $user = factory('App\User')->create();

        $this->assertSame(null, $user->currentVisit);
    }

    /** @test */
    public function a_user_with_only_completed_visits_returns_null_as_their_current_visit()
    {
        $user = factory('App\User')->create();

        factory('App\Visit', 2)->create([
            'user_id' => $user->id,
        ]);

        $this->assertSame(null, $user->currentVisit);
    }
}
