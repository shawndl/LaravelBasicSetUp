<?php

namespace Tests\Feature\acceptance\auth;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogInUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_must_be_active_to_login()
    {
        $this->createUser()
            ->login()
            ->assertSessionHas('error', 'Your account is not active');
        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function a_user_must_be_logged_in_if_active_and_credentials_are_correct()
    {
        $this->assertFalse(Auth::check());
        $this->createUser(true)
            ->login()
            ->assertSessionMissing('error');
        $this->assertTrue(Auth::check());
    }

    /**
     * creates a user
     *
     * @param bool $active
     * @return $this
     */
    private function createUser($active = false)
    {
        create(User::class, [
            'is_active' => $active,
            'username' => 'username',
            'password' => bcrypt('secret')
        ]);
        return $this;
    }

    /**
     * returns a login request
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function login()
    {
        return $this->post('login', [
            'username' => 'username',
            'password' => 'secret'
        ]);
    }
}
