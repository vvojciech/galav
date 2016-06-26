<?php

namespace App\Http\Controllers\Auth;

use App\OauthIdentity;
use App\User;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|alpha|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function authFacebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function authFacebookHandle() {
        $user = Socialite::driver('facebook')->user();
        return $this->handleProviderLogin($user, 'facebook');
    }

    public function authGoogleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function authGoogleHandle() {
        $user = Socialite::driver('facebook')->user();
        return $this->handleProviderLogin($user, 'google');
    }

    public function authTwitterRedirect() {
        return Socialite::driver('twitter')->redirect();
    }

    public function authTwitterHandle() {
        $user = Socialite::driver('twitter')->user();
        return $this->handleProviderLogin($user, 'twitter');
    }


    /**
     * @param $social_profile
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderLogin($social_profile, $provider)
    {

        // check for existing account via provider uid
        $oauth_identity = OauthIdentity::where('uid', $social_profile->id)->where('provider', $provider)->first();

        if (!$oauth_identity) { // oauth not found

            // @todo redirect if there is no email

            $user = User::create([
                'username' => ($social_profile->getNickname() ? $social_profile->getNickname() : $social_profile->getName()), // @todo verification
                'email' => ($social_profile->getEmail() ? $social_profile->getEmail() : 'fake' . rand(1, 1000) . '@test.com'), // @todo cases where you dont have that
                'password' => '',
            ]);

            OauthIdentity::create([
                'user_id' => $user->id,
                'uid' => $social_profile->id,
                'provider' => $provider,
            ]);

        } else { // we already have a user, lets auth him
            $user = User::where('id', $oauth_identity->user_id)->first();
        }

        Auth::login($user);

        return redirect('/')->with('message', 'Welcome to Galav!');

    }

}
