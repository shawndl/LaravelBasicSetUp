<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmationToken extends Model
{
    public $timestamps = false;

    protected $dates = [
        'expires_at'
    ];

    protected $fillable = [
        'token', 'expires_at'
    ];

    /**
     * routes will find this record by token
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    public static function boot()
    {
        static::creating(function($token)
        {
            optional($token->user->confirmationToken)->delete();
        });
    }

    /**
     * a token has a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * has the token expired
     *
     * @return bool
     */
    public function hasExpired()
    {
        return $this->freshTimestamp()->gt($this->expires_at);
    }
}
