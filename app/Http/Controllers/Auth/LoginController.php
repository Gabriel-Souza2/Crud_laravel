<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginSocial(Request $request)
    {
        $this->validate($request, [
            'social_type' => 'required|in:github,google'
        ]);

        $type = $request->get('social_type');
        \Session::put('social_type', $type);
        return Socialite::driver($type)->redirect();

    }

    public function loginCallback(Request $request)
    {
        $type = \Session::pull('social_type');
        $userSocial = Socialite::driver($type)->user();

        $user = User::where('email', $userSocial->email)->first();
        if(!$user)
        {
            $user =  User::create([
                'username' => $userSocial->name,
                'email' => $userSocial->email,
                'password' => bcrypt(str_random(8))

            ]);
        }

        \Auth::login($user);
        return redirect()->intended($this->redirectPath());
    }
}
