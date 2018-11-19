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

        $this->assertDatabaseMissing('visits', [
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->json('POST', '/visits');

        $this->assertDatabaseHas('visits', [
            'user_id' => $user->id
        ]);
    }
    
    /** @test */
    public function a_user_already_in_the_garage_cannot_store_an_entry_to_the_garage()
    {
        $user = factory('App\User')->create();

        $user->enterGarage();

        $this->actingAs($user)->json('POST', '/visits')->assertStatus(403);
    }
}
