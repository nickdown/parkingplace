<?php

namespace Tests\Unit\Rates;

use Tests\TestCase;
use App\Rates\OneHourRate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OneHourRateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function applicable_for_0_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now(),
            'ending_at' => now()
        ]);

        $rate = new OneHourRate($visit);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_1_hour_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(1),
            'ending_at' => now()
        ]);

        $rate = new OneHourRate($visit);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function not_applicable_for_1_hour_1_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(1)->subMinutes(1),
            'ending_at' => now()
        ]);

        $rate = new OneHourRate($visit);

        $this->assertFalse($rate->isApplicable());
    }
}
