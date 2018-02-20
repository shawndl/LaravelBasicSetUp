<?php
/**
 * Created by PhpStorm.
 * User: shawnlegge
 * Date: 4/2/18
 * Time: 4:27 PM
 */

namespace App\Traits\Controller;


trait MessageTrait
{
    protected $standardErrorMessage = 'An error occurred, please try again!';

    /**
     * @param string $message
     * @return redirect
     */
    public function backErrorMessage($message = null)
    {
        $message = (is_null($message)) ? $this->standardErrorMessage : $message;
        return back()->withError($message);
    }

    /**
     * redirects to a custom path with a standard message
     *
     * @param string $path
     * @param null $message
     * @return mixed
     */
    public function redirectErrorMessage($path = '/', $message = null)
    {
        $message = (is_null($message)) ? $this->standardErrorMessage : $message;
        return redirect()->intended($path)->withError($message);
    }
}