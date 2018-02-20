<?php

namespace Tests\Feature\acceptance\user\profile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePasswordAuthorisationTest extends TestCase
{
    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_user_must_be_signed_in_to_change_their_password()
    {
        $this->get(route('account.password.index'))
            ->assertRedirect('login');

        $this->post(route('account.password.store'))
            ->assertRedirect('login');
    }
}
