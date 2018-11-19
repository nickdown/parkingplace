<?php

namespace Tests\Unit;

use App\Garage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GarageSpotsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_garage_has_a_total_number_of_spots()
    {
        $spots = 10;
        $garage = new Garage();

        config(['garage.spots' => $spots]);

        $this->assertSame($spots, $garage->spots()->total());
    }

    /** @test */
    public function a_garage_has_an_available_number_of_spots()
    {
        $spots = 10;
        $garage = new Garage();

        config(['garage.spots' => $spots]);

        $this->assertSame($spots, $garage->spots()->total());
    }
}
