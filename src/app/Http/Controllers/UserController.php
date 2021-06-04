<?php

namespace Sparkouttech\UserAuth\app\Http\Controllers;

use Sparkouttech\UserAuth\app\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
