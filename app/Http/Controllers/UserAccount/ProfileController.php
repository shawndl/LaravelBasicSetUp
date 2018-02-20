<?php

namespace App\Http\Controllers\UserAccount;

use App\Http\Requests\UserAccount\ProfileStoreRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * view the users profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('account.profile.index');
    }

    /**
     * updates the users profile
     *
     * @param ProfileStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfileStoreRequest $request)
    {
        try {
            $request->user()
                ->update($request->only('first_name', 'last_name', 'username', 'email'));
        } catch (\Exception $exception) {
            return $this->backErrorMessage();
        }


        return back()->withSuccess('Your profile has been updated!');
    }
}
