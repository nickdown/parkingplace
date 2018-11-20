<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_user_can_store_an_entry_to_the_garage()
    {
        $user = factory('App\User')->create();

        $this->assertDatabaseMissing('tickets', [
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->json('POST', '/tickets');

        $this->assertDatabaseHas('tickets', [
            'user_id' => $user->id
        ]);
    }
    
    /** @test */
    public function a_user_already_in_the_garage_cannot_store_an_entry_to_the_garage()
    {
        $user = factory('App\User')->create();

        $user->garage()->enter();

        $this->actingAs($user)->json('POST', '/tickets')->assertStatus(403);
    }

    /** @test */
    public function a_user_cant_enter_when_garage_is_full()
    {
        $user = factory('App\User')->create();

        config(['garage.spots' => 3]);

        $ticket = factory('App\Ticket', 3)->create([
            'ending_at' => null
        ]);

        $this->actingAs($user)->json('POST', '/tickets')->assertStatus(403);
    }
}
