<?php

namespace Tests\Unit\Rates;

use Tests\TestCase;
use App\Rates\AllDayRate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllDayRateTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function not_applicable_for_6_hour_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(6),
            'ending_at' => now()
        ]);

        $rate = new AllDayRate($visit);

        $this->assertFalse($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_6_hour_one_minute_visit()
    {
        $visit = factory('App\Visit')->create([
            'starting_at' => now()->subHours(6)->subMinutes(1),
            'ending_at' => now()
        ]);

        $rate = new AllDayRate($visit);

        $this->assertTrue($rate->isApplicable());
    }
}
