<?php

namespace Sparkouttech\UserAuth\app\Http\Controllers;

use Illuminate\Http\Request;
use Sparkouttech\UserAuth\app\Requests\CheckEmailRequest;
use Sparkouttech\UserAuth\app\Requests\SetPasswordRequest;
use Sparkouttech\UserAuth\Repositories\UserRepository;

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
                $email=new SendmailJob($userExist);
                dispatch($email);
                return back();
            }else{
                return back()->with('error','Your email is not found');
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
