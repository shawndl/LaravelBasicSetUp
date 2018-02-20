<?php

namespace Tests\Feature\acceptance\user\profile;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\View\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfilePageTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_user_must_be_logged_in_to_access_the_profile_page()
    {
        $this->get(route('account.profile.index'))
            ->assertRedirect('login');
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_logged_in_user_can_access_the_profile_page()
    {
        $this->signIn();
        $this->get(route('account.profile.index'))
            ->assertViewIs('account.profile.index');
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function the_profile_page_must_have_a_login_form()
    {
        $this->signIn();
        $this->get(route('account.profile.index'))
            ->assertSee('Edit Your Profile');
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function if_the_user_submits_an_edit_profile_request_then_the_users_details_will_be_changed()
    {
        $user = create(User::class, ['username' => 'happy']);
        $this->signIn($user);
        $this->post(route('account.profile.store'), [
            'first_name' => 'sam',
            'last_name' => 'sam',
            'username' => 'sad',
            'email' => 'john@gmail.com',
        ]);
        $this->assertEquals('sad', $user->fresh()->username);
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_user_must_be_signed_in_to_edit_their_profile()
    {
        $this->post(route('account.profile.index'), [
            'username' => 'sad'
        ])->assertRedirect('login');
    }
}
