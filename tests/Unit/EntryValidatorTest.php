<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\EntryValidator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntryValidatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function entry_validator_confirms_user()
    {
        $user = factory('App\User')->create();
        $entryValidator = new EntryValidator();

        $this->assertTrue($entryValidator->confirm($user));
    }
}
