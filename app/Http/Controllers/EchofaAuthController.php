<?php

namespace App\Http\Controllers;

use App\EchofaUser;
use App\Http\Middleware\EchofaAuth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EchofaAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'echofa/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm()
    {
        return view('echofa.login');
    }

    public function login(Request $request, EchofaUser $user)
    {
        $arr = [
          'usercode' => $request->post('usercode'),
          'password' => $request->post('password')
        ];
        $userId = $user->getEchofaUserIdByUsercodeAndPassword($arr);

        $res = Auth::guard('echofa')->loginUsingId($userId, true);
        if($res){
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo);
        }else{
            throw ValidationException::withMessages([
                'usercode' => ['用户名或密码不正确'],
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('echofa')->logout();

        $request->session()->invalidate();

        return redirect('/echofa/login');
    }
}
