<?php

namespace Tests\Unit\Rates;

use Tests\TestCase;
use App\Rates\SixHourRate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SixHourRateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function not_applicable_for_3_hour_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(3),
            'ending_at' => now()
        ]);

        $rate = new SixHourRate($visit);

        $this->assertFalse($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_3_hour_1_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(3)->subMinutes(1),
            'ending_at' => now()
        ]);

        $rate = new SixHourRate($visit);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_6_hour_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(6),
            'ending_at' => now()
        ]);

        $rate = new SixHourRate($visit);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function not_applicable_for_6_hour_1_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(6)->subMinutes(1),
            'ending_at' => now()
        ]);

        $rate = new SixHourRate($visit);

        $this->assertFalse($rate->isApplicable());
    }
}
