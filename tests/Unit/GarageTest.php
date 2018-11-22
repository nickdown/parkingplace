<?php

namespace Tests\Unit;

use App\Garage;
use App\Ticket;
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

        $ticket = factory('App\Ticket', 2)->create([
            'exited_at' => null
        ]);

        $this->assertFalse($garage->full());
    }

    /** @test */
    public function garage_is_full()
    {
        $garage = new Garage;
        config(['garage.spots' => 3]);

        $ticket = factory('App\Ticket', 3)->create([
            'exited_at' => null
        ]);

        $this->assertTrue($garage->full());
    }

    /** @test */
    public function garage_enter_returns_a_ticket()
    {
        $user = factory('App\User')->create();
        $garage = new Garage();

        $ticket = $user->garage()->enter();

        $this->assertInstanceOf(Ticket::class, $ticket);
    }

    /** @test */
    public function garage_exit_returns_a_ticket()
    {
        $user = factory('App\User')->create();
        $garage = new Garage();

        $user->garage()->enter();

        $ticket = $user->garage()->exit();

        $this->assertInstanceOf(Ticket::class, $ticket);
    }
}
