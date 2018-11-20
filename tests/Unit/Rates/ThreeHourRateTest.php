<?php

namespace Tests\Unit\Rates;

use Tests\TestCase;
use App\Rates\ThreeHourRate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreeHourRateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function not_applicable_for_60_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(1),
            'ending_at' => now()
        ]);

        $rate = new ThreeHourRate($visit);

        $this->assertFalse($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_1_hour_1_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(1)->subMinutes(1),
            'ending_at' => now()
        ]);

        $rate = new ThreeHourRate($visit);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_3_hour_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(3),
            'ending_at' => now()
        ]);

        $rate = new ThreeHourRate($visit);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function not_applicable_for_3_hour_1_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(3)->subMinutes(1),
            'ending_at' => now()
        ]);

        $rate = new ThreeHourRate($visit);

        $this->assertFalse($rate->isApplicable());
    }
}
