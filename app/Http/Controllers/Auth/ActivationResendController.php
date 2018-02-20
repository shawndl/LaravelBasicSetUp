<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestActivationEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ActivationResendRequest;
use App\User;

class ActivationResendController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.activation.resend.index');
    }

    /**
     * resends the activation email
     *
     * @param ActivationResendRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ActivationResendRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!optional($user)->hasActivated())
        {
            event(new UserRequestActivationEmail($user));
        }

        return redirect()->route('login')->withSuccess('An activation email has been sent');
    }
}
