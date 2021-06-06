<?php

namespace Sparkouttech\UserAuth\App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Sparkouttech\UserAuth\App\Requests\LoginRequest;
use Sparkouttech\UserAuth\App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $userRepository;
    private $config;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->config = config('user-auth');
    }

    public function login(Request $request)
    {
        return view('user-auth::login');
    }

    /**
     * @param LoginRequest $request
     */
    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if ($request->expectsJson() == true) {
                return response()->json(['status'=>true,'message'=>'Login success','data'=>Auth::user()]);
            } else {
                $request->session()->put('user',Auth::user());
                $request->session()->put('token',Auth::id());
                return redirect($this->config['login_redirect'])->with('message','Login success');
            }
        } else {
            if ($request->expectsJson() == true) {
                return response()->json(['status'=>false,'message'=>'Login failed','data'=>(object)[]]);
            } else {
                Session::flash('error', 'Invalid credentials');
                return back();
            }
        }
    }
}
