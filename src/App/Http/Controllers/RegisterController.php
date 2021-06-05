<?php

namespace Sparkouttech\UserAuth\App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Sparkouttech\UserAuth\App\Events\NewUserRegisteredEvent;
use Sparkouttech\UserAuth\App\Jobs\WelcomEmailJob;
use Sparkouttech\UserAuth\App\Requests\RegisterRequest;
use Sparkouttech\UserAuth\App\Repositories\UserRepository;

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
        event(new NewUserRegisteredEvent($requestData, $user));
        if ($request->expectsJson() == true) {
            // Api route
            return response()->json(['status'=>true,'message'=>'User account created successfully','data'=>$user]);
        } else {
            // web logic
            $request->session()->put('user',$user);
            $request->session()->put('userId',$user->id);
            return redirect('/')->with('message','User account created successfully');
        }
    }
}
