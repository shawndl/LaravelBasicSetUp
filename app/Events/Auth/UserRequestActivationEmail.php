<?php

namespace App\Events\Auth;


use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


class UserRequestActivationEmail
{
    use Dispatchable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
