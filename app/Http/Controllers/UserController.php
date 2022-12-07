<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Services\UserService\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login()
    {
        return view('users.login', ['title' => 'Login']);
    }
    public function register()
    {
        return view('users.register', ['title' => 'Register']);
    }
    public function forgotPass()
    {
        return view('users.forgot', ['title' => 'Forgot Password']);
    }

    public function create(StoreUserRequest $request)
    {
        $this->userService->create($request->input());
        Session::flash('success', 'Register success!');
        return redirect()->route('home');
    }
    public function store(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            if (Auth::user()->role == 1) {
                return redirect()->route('dashboard')->with(['active' => 'dashboard']);;
            }
            return  redirect()->route('home');
        }
        Session::flash('error', 'Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function profile()
    {
        return view('users.profile', ['title' => 'Profile']);
    }
    public function updatePass(Request $request)
    {
        if (!(Hash::check($request->get('oldPassword'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Your current password does not matches with the password.");
        }
        if (strcmp($request->get('oldPassword'), $request->get('newPassword')) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }
        $this->userService->updatePass($request);
        return redirect()->back()->with("success", "Password successfully changed!");
    }
    public function update(UpdateRequest $request)
    {
        $this->userService->update($request);
        return redirect()->back()->with("success", "Profile successfully changed!");
    }
    public function updateAvatar(Request $request)
    {
        if ($this->userService->updateAvatar($request)) {
            return response()->json(['error' => false, 'msg' => 'Update avatar success. >.<']);
        }
        return response()->json(['error' => true, 'msg' => 'Update avatar failer']);
    }
}
