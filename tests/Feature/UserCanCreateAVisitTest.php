<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCanCreateAVisitTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_can_create_a_visit()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)->json('POST', '/api/visits')->assertStatus(201);
    }

    /** @test */
    public function a_user_who_cannot_enter_the_garage_cannot_create_a_visit()
    {
        $user = factory('App\User')->create();

        $user->enterGarage();

        //since the user is already in the garage they will be forbidden from creating another visit
        $this->actingAs($user)->json('POST', '/api/visits')->assertStatus(403);
    }

    /** @test */
    public function a_user_who_creates_a_visit_will_be_in_the_garage()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)->json('POST', '/api/visits');

        $this->assertTrue($user->isInGarage());
    }

    /** @test */
    public function a_user_who_creates_a_visit_will_not_be_allowed_to_immediately_reenter_the_garage()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)->json('POST', '/api/visits');

        $this->assertFalse($user->canEnterGarage());
    }
}
