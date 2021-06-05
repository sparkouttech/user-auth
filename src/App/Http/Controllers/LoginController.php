<?php

namespace Sparkouttech\UserAuth\App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Sparkouttech\UserAuth\App\Requests\LoginRequest;
use Sparkouttech\UserAuth\App\Repositories\UserRepository;

class LoginController extends Controller
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
        $user = $this->userRepository->findOne('email',$request['email']);
        if (isset($user)) {
            if (Hash::check($request['password'], $user->password)) {
                // Login success
                $request->session()->put('user',$user);
                $request->session()->put('userId',$user->id);
                return back()->with('message','Login success');
            } else {
                // Password doesn't match
                Session::flash('error', 'This is a message!');
                return back()->with('error','Password doesnt match with that account');
            }
        } else {
            // Email not exists
            Session::flash('error', 'This is a message!');
            return back()->with('error','Email id doesnt match');
        }
    }
}
