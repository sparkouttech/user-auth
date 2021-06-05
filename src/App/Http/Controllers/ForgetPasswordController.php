<?php

namespace Sparkouttech\UserAuth\App\Http\Controllers;

use Illuminate\Http\Request;
use Sparkouttech\UserAuth\App\Jobs\ForgetPasswordEmailJob;
use Sparkouttech\UserAuth\App\Requests\CheckEmailRequest;
use Sparkouttech\UserAuth\App\Requests\SetPasswordRequest;
use Sparkouttech\UserAuth\App\Repositories\UserRepository;

class ForgetPasswordController extends Controller
{

    private $userRepository;

    /**
     * ForgetPasswordController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function forgetPasswordPage(Request  $request)
    {
        return view('user-auth::forget-password');
    }

    public function verifyPassword($id)
    {
        return view('user-auth::reset-password',compact('id'));
    }

    public function checkEmail(CheckEmailRequest $request){
        try{

            $userExist = $this->userRepository->findOne('email',$request->email);
            if($userExist){
                dispatch(new ForgetPasswordEmailJob($userExist));
                return back()->with('message','Password reset link has been sent to your email');
            }else{
                return back()->with('error','Entered email not match with any account');
            }
        }catch(Throwable $exception){
            return back()->with('error',$exception->getMessages());
        }
    }

    public function setPassword(SetPasswordRequest $request)
    {
        try{
            $this->userRepository->update($request->id, ['password' => $request->password]);
            return redirect()->route('userAuth.login.page');
        }catch(Throwable $exception){
            return back()->with('errors',$exception->getMessages());
        }
    }
}
