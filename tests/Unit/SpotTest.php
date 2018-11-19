<?php

namespace Tests\Unit;

use App\Spot;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpotTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_spot_returns_the_total_spots_config_value_as_an_integer()
    {
        $spots = 10;
        $spot = new Spot();

        //set the config as a string
        config(['garage.spots' => (string) $spots]);

        //assert it has to be returned as an integer
        $this->assertInternalType('int', $spot->total());
    }

    /** @test */
    public function a_spot_returns_the_used_spots()
    {
        $garageSpots = new Spot();

        $this->assertSame(0, $garageSpots->used());

        factory('App\Visit', 3)->create([
            'ending_at' => null
        ]);

        $this->assertSame(3, $garageSpots->used());
    }

    /** @test */
    public function a_spot_returns_the_available_spots()
    {
        $garageSpots = new Spot();

        config(['garage.spots' => 10]);

        $this->assertSame(10, $garageSpots->available());

        factory('App\Visit', 3)->create([
            'ending_at' => null
        ]);

        $this->assertSame(7, $garageSpots->available());
    }

    /** @test */
    public function a_spot_returns_the_available_spots_with_a_minimum_of_zero()
    {
        $garageSpots = new Spot();

        config(['garage.spots' => 10]);

        $this->assertSame(10, $garageSpots->available());

        factory('App\Visit', 11)->create([
            'ending_at' => null
        ]);
        
        $this->assertSame(0, $garageSpots->available());
    }
}
