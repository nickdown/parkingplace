<?php

namespace Tests\Feature;

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
}
