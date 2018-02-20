<?php

namespace Tests\Feature\acceptance\user\profile;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePasswordValidationTest extends TestCase
{
    use DatabaseMigrations, \ValidationTestTrait;

    /**
     * @var array
     */
    protected $post = [
        'current_password' => 'secret',
        'password' => 'password',
        'password_confirmation' => 'password'
    ];

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function the_current_password_is_required()
    {
        $this->post['current_password'] = '';
        $this->signIn();
        $this->post(route('account.password.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The current password field is required.',
            $this->validationError('current_password'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_user_password_must_be_correct()
    {
        $user = create(User::class, ['password' => 'secret']);
        $this->post['current_password'] = 'password';
        $this->signIn($user);
        $this->post(route('account.password.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('Your current password is incorrect!',
            $this->validationError('current_password'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_new_password_is_required()
    {
        $this->post['password'] = '';
        $this->signIn();
        $this->post(route('account.password.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The password field is required.',
            $this->validationError('password'));
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function the_new_password_and_confirmed_password_must_match()
    {
        $this->post['password'] = 'not_password';
        $this->signIn();
        $this->post(route('account.password.store'), $this->post)
            ->assertSessionHasErrors();
        $this->assertEquals('The password confirmation does not match.',
            $this->validationError('password'));
    }
}
