<?php

namespace Tests\Unit;

use App\Rates\Rate;
use Tests\TestCase;
use App\RateCalculator;
use App\Rates\RateInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RateCalculatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function rate_calculator_returns_a_rate()
    {
        $visit = factory('App\Visit')->create();

        $rate = RateCalculator::determine($visit);

        $this->assertInstanceOf(Rate::class, $rate);
    }
}
