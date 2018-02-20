<?php

namespace Tests\Feature\acceptance\user\account;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountsUsersAccountPageTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var string
     */
    protected $url;

    protected function setUp()
    {
        parent::setUp();
        $this->url = route('account.index');
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_user_must_be_logged_in_to_access_their_account()
    {
        $this->get($this->url)->assertRedirect('login');
    }

    /**
     * @group account
     * @group acceptance
     * @test
     */
    public function a_logged_in_user_can_access_the_profile_page()
    {
        $this->signIn();
        $this->get($this->url)->assertViewIs('account.index');
    }
}
