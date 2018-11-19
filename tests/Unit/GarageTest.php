<?php

namespace Tests\Unit;

use App\Garage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GarageTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function garage_is_not_full()
    {
        $garage = new Garage;
        config(['garage.spots' => 3]);

        $visit = factory('App\Visit', 2)->create([
            'ending_at' => null
        ]);

        $this->assertFalse($garage->full());
    }

    /** @test */
    public function garage_is_full()
    {
        $garage = new Garage;
        config(['garage.spots' => 3]);

        $visit = factory('App\Visit', 3)->create([
            'ending_at' => null
        ]);

        $this->assertTrue($garage->full());
    }
}
