<?php

namespace Tests\Feature\acceptance\auth;

use App\ConfirmationToken;
use App\Mail\Auth\ActivationEmail;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use DatabaseMigrations, \TestEmailsTrait;

    /**
     * @var TestResponse
     */
    protected $post;

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
        $this->setUpEmails();
        $this->post = $this->post('register', $user);
    }

    /**
     * @group auth
     * @group acceptance
     * @test
     */
    public function a_users_details_must_be_added_to_the_database()
    {
        $this->assertDatabaseHas('users', [
            'username' => 'joesmith',
        ]);
    }

    /**
     * @group auth
     * @group acceptance
     * @test
     */
    public function it_must_return_the_user_to_the_home_page_with_a_success_message()
    {
        $this->post->assertRedirect('/')
            ->assertSessionHas('success', 'Your registration is successful, please check your email to activate your account!');
    }

    /**
     * @group auth
     * @group acceptance
     * @test
     */
    public function it_must_not_sign_the_user_in_after_registration()
    {
        $this->assertFalse(Auth::check());
    }

    /**
     * @group auth
     * @group acceptance
     * @test
     */
    public function a_user_confirmation_email_must_be_sent_after_registering()
    {
        $this->seeEmailWasSent()
            ->seeEmailTo('testemail@test.com')
            ->seeEmailFrom('hello@example.com')
            ->seeEmailSubject('Activate Account')
            ->seeEmailContains('Please follow the link below to activate your account. The link will remain valid for 30 minutes.')
            ->seeEmailContains('Your user account with the e-mail address testemail@test.com has been created.');
    }

    /**
     * @group auth
     * @group acceptance
     * @test
     */
    public function a_user_must_be_able_to_activate_thier_account_with_the_registration_token()
    {
        $user = User::first();
        $this->get(route('activation.activate', $user->token()->first()->token))
            ->assertSessionHas('success', 'Congratulations, your account has been activated!');

        $this->assertEquals(1, $user->fresh()->hasActivated());

        $this->assertTrue(Auth::check());
    }
}
