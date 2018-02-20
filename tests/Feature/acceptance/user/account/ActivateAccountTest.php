<?php

namespace Tests\Feature\acceptance\user\account;

use App\ConfirmationToken;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivateAccountTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $user = [
            'first_name' => 'Joe',
            'last_name' => 'Smith',
            'username' => 'joesmith',
            'email' => 'testemail@test.com',
            'password'              => 'passwordtest',
            'password_confirmation' => 'passwordtest'
        ];
        $this->post('register', $user);
        $this->user = User::where('username', 'joesmith')->first();
        $token = ConfirmationToken::where('user_id', $this->user->id)->first();
        $this->get(route('activation.activate', ['confirmation_token' => $token]));

    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_user_must_be_able_to_activate_their_account()
    {
        $this->assertTrue($this->user->fresh()->hasActivated());
    }
}
