<?php
namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
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

    protected $guard = 'admin';
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void

     */
    public function __construct()
    {
        $this->middleware(['guest', 'locale'])->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $login = auth($this->guard)
            ->attempt(
                [
                    'email' => $request->email,
                    'password' => $request->password
                ],
                $request->filled('remember')
            );

        if ($login) {
            return redirect($this->redirectTo);
        }

        return back()->withErrors(['email' => 'Email or password are wrong']);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth($this->guard)->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect(route('admin.login'));
    }
}
