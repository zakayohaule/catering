<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

//    /**
//     * Where to redirect users after login / registration.
//     *
//     * @var string
//     */
//    protected $redirectTo = '/home';

    public function redirectPath()
    {
        if(auth()->user()->role == 'customer')
        {
            return 'customer/dashboard';
        }
        else
            return 'admin/dashboard';

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticated(Request $request, $user)
    {
        if(!$user->verified)
        {
            auth()->logout();
            return back()->with('warning' , 'You need to confirm your email, we have sent you an activation code, please check your email');
        }

        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('index');
    }

}
