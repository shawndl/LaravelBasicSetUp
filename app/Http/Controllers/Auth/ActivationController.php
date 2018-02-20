<?php

namespace App\Http\Controllers\Auth;

use App\ConfirmationToken;
use App\Traits\Controller\MessageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    use MessageTrait;

    /**
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * ActivationController constructor.
     */
    public function __construct()
    {
        $this->middleware('confirmation_token.expired:/');
    }


    /**
     * activate the user account if the token matches the user
     *
     * @param ConfirmationToken $token
     * @param Request $request
     * @return mixed
     */
    public function activate(ConfirmationToken $token, Request $request)
    {
        try {
            $user = $token->user;
            $user->is_active = true;
            $user->save();
            $token->delete();
        } catch (\Exception $exception) {
            return $this->redirectErrorMessage();
        }

        Auth::loginUsingId($user->id);

        return redirect()
            ->intended($this->redirectTo)
            ->withSuccess('Congratulations, your account has been activated!');
    }
}
