<?php

namespace LACC\Http\Controllers\Auth;

use Illuminate\Http\Request;
use LACC\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use LACC\Models\Admin;

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
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Muda o nome do input email para username que vem do formulario do login
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Sobreescreve a forma de autenticação para poder logar tando com email quanto enrolment
     * @param Request $request
     * @return array
     */
    public function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password');

        $userNameKey = $this->userNameKey();
        $data[$userNameKey] = $data[$this->username()];
        $data['userable_type'] = Admin::class;
        unset($data[$this->username()]);

        return $data;
    }

    /**
     * Metodo que verifica se foi passado um email ou registro no formulario de login
     * para retornar ao metodo credentials o campo email ou enrolment
     * @return string
     */
    protected function userNameKey()
    {
        $email = \Request::get($this->username());

        $validators = \Validator::make([
            'email' => $email
        ], ['email' => 'email']);

        return $validators->fails() ? 'enrolment' : 'email';
    }
}
