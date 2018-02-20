<?php
/**
 * Created by PhpStorm.
 * User: shawnlegge
 * Date: 4/2/18
 * Time: 5:16 PM
 */

namespace App\Traits\Model;


use App\ConfirmationToken;

trait HasConfirmation
{
    /**
     * generates a confirmation token for the user
     */
    public function generateConfirmationToken()
    {
        return $this->confirmationToken()->create([
            'token' => str_random(200),
            'expires_at' => $this->getConfirmTokenExpire()
        ])->token;
    }

    /**
     * a user has one confirmation token
     *
     * @return mixed
     */
    public function confirmationToken()
    {
        return $this->hasOne(ConfirmationToken::class);
    }

    /**
     * generates an expirary date of 30 minutes from now
     *
     * @return string
     */
    protected function getConfirmTokenExpire()
    {
        return $this->freshTimestamp()->addMinutes(30);
    }
}