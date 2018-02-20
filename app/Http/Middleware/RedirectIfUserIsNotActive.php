<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class RedirectIfUserIsNotActive
{
    /**
     * @var User
     */
    protected $user;

    /**
     * RedirectIfUserIsNotActive constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->user->username($request->username);
        if(isset($user->id) && !$user->hasActivated())
        {
            return back()->withError('Your account is not active');
        }

        return $next($request);
    }
}
