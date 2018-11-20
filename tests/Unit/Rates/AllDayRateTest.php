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
    public function not_applicable_for_6_hour_ticket()
    {
        $ticket = factory('App\Ticket')->create([
            'entered_at' => now()->subHours(6),
            'exited_at' => now()
        ]);

        $rate = new AllDayRate($ticket);

        $this->assertFalse($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_6_hour_one_minute_ticket()
    {
        $ticket = factory('App\Ticket')->create([
            'entered_at' => now()->subHours(6)->subMinutes(1),
            'exited_at' => now()
        ]);

        $rate = new AllDayRate($ticket);

        $this->assertTrue($rate->isApplicable());
    }
}
