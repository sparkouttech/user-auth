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

    public function resp($request,$error, $errorMessage, $data) {
        if ($request->expectsJson() == true) {
            // Api route
            return response()->json(['status'=>!$error,'message'=>$errorMessage,'data'=>$data]);
        } else {
            if ($error == true) {
                Session::flash('error', $errorMessage);
                return back();
            } else {
                $request->session()->put('user',$data);
                $request->session()->put('userId',$data->id);
                return redirect('/')->with('message','Login success');
            }
        }
    }
    /**
     * @param LoginRequest $request
     */
    public function doLogin(LoginRequest $request)
    {
        $requestData = $request->all();
        $user = $this->userRepository->findOne('email',$requestData['email']);
        if (isset($user)) {
            if (Hash::check($requestData['password'], $user->password)) {
                // Login success
                return $this->resp($request, false,'Login success',$user);
            } else {
                // Password doesn't match
                return $this->resp($request, true,'Password not match with account',$user);
            }
        } else {
            // Email not exists
            return $this->resp($request, true,'Email id not match with any account',(object)[]);
        }
    }
}
