<?php

namespace Sparkouttech\UserAuth\app\Http\Controllers;

use Sparkouttech\UserAuth\app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sparkouttech\UserAuth\app\Http\Requests\LoginRequest;
use Sparkouttech\UserAuth\app\Http\Requests\RegisterRequest;
use Sparkouttech\UserAuth\Models\User;

use Sparkouttech\UserAuth\Repositories\UserRepository;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

    }

    public function register(Request $request)
    {
        return view('user-auth::register');
    }

    public function doRegister(RegisterRequest $request)
    {
        $user = User::create($request->all());
        session('user',$user);
        session('userId',$user->id);
        return back()->with('message','User account created successfully');
    }
}
