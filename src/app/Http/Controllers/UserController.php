<?php

namespace Sparkouttech\UserAuth\app\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Sparkouttech\UserAuth\app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sparkouttech\UserAuth\app\Requests\LoginRequest;
use Sparkouttech\UserAuth\app\Requests\RegisterRequest;
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
        $request = $request->all();
        $user = User::where('email', '=', $request['email'])->first();
        if ($user) {
            if (Hash::check($request['password'], $user->password))
            {
                // The passwords match...
                return back()->with('message','Login success');
            } else {
                return back()->with('error','Password doesnt match with that account');
            }
        } else {
            return back()->with('error','Email id doesnt match');
        }
    }

    public function register(Request $request)
    {
        return view('user-auth::register');
    }

    public function doRegister(RegisterRequest $request)
    {
        $requestData = $request->all();
        $requestData["password"] = Hash::make($requestData["password"]);
        $user = User::create($requestData);
        session('user',$user);
        session('userId',$user->id);
        return back()->with('message','User account created successfully');
    }
}
