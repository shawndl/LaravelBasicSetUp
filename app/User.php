<?php

namespace App;

use App\Traits\Model\HasConfirmation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasConfirmation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return string
     */
    public function fullName()
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * finds user by username
     *
     * @param Builder $builder
     * @param string $value
     * @return Builder
     */
    public function scopeUsername(Builder $builder, string $value)
    {
        return $builder->where('username', $value)->first();
    }

    /**
     * a user can have an activation token
     */
    public function token()
    {
        return $this->hasMany(ConfirmationToken::class);
    }

    /**
     * has the user confirmed their email address
     *
     * @return boolean
     */
    public function hasActivated()
    {
        return ((int)$this->is_active === 1) ? true : false;
    }
}
