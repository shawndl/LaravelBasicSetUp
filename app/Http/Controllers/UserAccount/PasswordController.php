<?php

namespace App\Http\Controllers\UserAccount;

use App\Http\Requests\UserAccount\ChangeUserPasswordRequest;
use App\Mail\UserAccount\PasswordUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('account.password.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ChangeUserPasswordRequest $request)
    {
        try {
            Mail::to($request->user())->send(new PasswordUpdated());

            $request->user()->update([
                'password' => bcrypt($request->password)
            ]);
        } catch (\Exception $exception) {
            return $this->backErrorMessage();
        }

        return back()->withSuccess('Your password has been updated!');
    }
}
