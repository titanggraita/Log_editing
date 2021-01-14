<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Qwildz\SSOClient\SSOClient;

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

    use AuthenticatesUsers {
        logout as private logoutTrait;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginSSO()
    {
        return Socialite::with('sso')->redirect();
    }

    public function callback(SSOClient $client)
    {
        $user = Socialite::with('sso')->user();

        session()->put('sso_instance', $user);
        session()->put('access_token', $user->token);
        session()->put('internal_user', (bool) $user->internal);

        $userInstance = $this->findUser($user);

        if($userInstance) {
            auth()->login($userInstance);
            $client->setSid($user->token);
            return redirect()->intended();
        } else {
            session()->put('no_access', true);
            return $this->noAccess();
        }
    }

    public function logout(Request $request, SSOClient $client)
    {
        // dd($client);
        if(auth()->check()) {
            $client->logout();
        }

        return $this->logoutTrait($request);
    }

    private function noAccess()
    {
        return redirect()->to(config('sso.url') . '/noaccess?client_id=' . config('sso.client_id'));
    }

    private function findUser($user)
    {
        $changeNik = false;
        $authUser = User::where('logeditingpriviledge_nik', $user->nik)->first();

        // if (!$authUser) {
        //     $authUser = User::where('nik', $user->nik_lama)->first();
        //     $changeNik = true;
        // }

        // if($changeNik && $authUser) {
        //     $authUser->nik = $user->nik;
        //     $authUser->save();
        // }

        if ($authUser) {
            return $authUser;
        }
    }
}
