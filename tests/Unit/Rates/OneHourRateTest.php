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
    public function applicable_for_0_minute_ticket()
    {
        $ticket = factory('App\Ticket')->create([
            'entered_at' => now(),
            'exited_at' => now()
        ]);

        $rate = new OneHourRate($ticket);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function applicable_for_1_hour_ticket()
    {
        $ticket = factory('App\Ticket')->create([
            'entered_at' => now()->subHours(1),
            'exited_at' => now()
        ]);

        $rate = new OneHourRate($ticket);

        $this->assertTrue($rate->isApplicable());
    }

    /** @test */
    public function not_applicable_for_1_hour_1_minute_ticket()
    {
        $ticket = factory('App\Ticket')->create([
            'entered_at' => now()->subHours(1)->subMinutes(1),
            'exited_at' => now()
        ]);

        $rate = new OneHourRate($ticket);

        $this->assertFalse($rate->isApplicable());
    }
}
