<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitHasTimesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_visit_cannot_have_a_null_starting_at_time()
    {
        try {
            $visit = factory('App\Visit')->create([
                'starting_at' => null
            ]);
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function a_visit_has_a_starting_at_time()
    {
        $visit = factory('App\Visit')->create();

        $this->assertTrue($visit->starting_at instanceOf \DateTime);
    }


    /** @test */
    public function a_visit_can_have_a_null_ending_at_time()
    {
        $visit = factory('App\Visit')->create([
            'ending_at' => null
        ]);

        $this->assertNull($visit->ending_at);
    }

    /** @test */
    public function a_visit_can_have_an_ending_at_time()
    {
        $visit = factory('App\Visit')->create();

        $this->assertInstanceOf(Carbon::class, $visit->ending_at);
    }
}
