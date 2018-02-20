<?php

namespace Tests\Feature\acceptance\user\profile;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfilePageValidationTest extends TestCase
{
    use DatabaseMigrations, \ValidationTestTrait;

    protected $post = [
        'first_name' => 'tom',
        'last_name' => 'smith',
        'email' => 'tom@gmail.com',
        'username' => 'tommyboy'
    ];

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_first_name_is_required()
    {
        $this->post['first_name'] = '';

        $this->signIn();
        $this->post(route('account.profile.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The first name field is required.',
            $this->validationError('first_name'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_last_name_is_required()
    {
        $this->post['last_name'] = '';
        $this->signIn();
        $this->post(route('account.profile.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The last name field is required.',
            $this->validationError('last_name'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_username_is_required()
    {
        $this->post['username'] = '';
        $this->signIn();
        $this->post(route('account.profile.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The username field is required.',
            $this->validationError('username'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_username_must_be_unique()
    {
        create(User::class, ['username' => 'candy']);
        $this->post['username'] = 'candy';
        $this->signIn();
        $this->post(route('account.profile.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The username has already been taken.',
            $this->validationError('username'));
    }


    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function an_email_is_required()
    {
        $this->post['email'] = '';
        $this->signIn();
        $this->post(route('account.profile.store'), $this->post)
            ->assertSessionHasErrorsIn('The email field is required.');
        $this->assertEquals('The email field is required.',
            $this->validationError('email'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function an_email_must_be_an_email()
    {
        $this->post['email'] = 'email';
        $this->signIn();
        $this->post(route('account.profile.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The email must be a valid email address.',
            $this->validationError('email'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function an_email_must_be_unique()
    {
        create(User::class, ['email' => 'taken@company.com']);

        $this->post['email'] = 'taken@company.com';
        $this->signIn();
        $this->post(route('account.profile.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The email has already been taken.',
            $this->validationError('email'));
    }
}
