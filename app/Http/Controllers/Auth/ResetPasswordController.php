<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the password reset view for the given token.
     * No emails needed
     *
     * @param  string $token
     *
     */
    public function showResetForm( Request $request, $token = null)
    {
        if (auth()->guest() && is_null( $token )) {
            return redirect('welcome');
        }

        if (auth()->check() && is_null( $token )) {
            // user is logged in and has no token, in other words, he/she access this route by
            // clicking a link pointing to "password/reset", so we generate a new token and save it
            // to the password_resets table
            $token = Password::getRepository()->create( auth()->user() );
        }

        return view( 'auth.passwords.reset' )->with( 'token', $token );
    }

}
