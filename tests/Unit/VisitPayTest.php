<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitPayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_visit_can_be_paid()
    {
        $visit = factory('App\Visit')->create([
            'paid_amount' => null,
            'paid_at' => null
        ]);

        $this->assertFalse($visit->isPaid());
    }

    /** @test */
    public function a_visit_can_be_unpaid()
    {
        $visit = factory('App\Visit')->create([
            'paid_amount' => 300,
            'paid_at' => now()
        ]);

        $this->assertTrue($visit->isPaid());
    }
}
