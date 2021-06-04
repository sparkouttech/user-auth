<?php

namespace Sparkouttech\UserAuth\app\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Sparkouttech\UserAuth\app\Requests\RegisterRequest;
use Sparkouttech\UserAuth\Repositories\UserRepository;

class RegisterController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        return view('user-auth::register');
    }

    public function doRegister(RegisterRequest $request)
    {
        $requestData = $request->all();
        $requestData["password"] = Hash::make($requestData["password"]);
        $user = $this->userRepository->create($requestData);
        $request->session()->put('user',$user);
        $request->session()->put('userId',$user->id);
        return back()->with('message','User account created successfully');
    }
}
