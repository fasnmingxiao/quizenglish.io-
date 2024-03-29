<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Services\UserService\UserService;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // // Google login
    // public function redirectToGoogle()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // // Google callback|
    // public function handleGoogleCallback()
    // {
    //     $user = Socialite::driver('google')->user();

    //     $this->_registerOrLoginUser($user);

    //     return redirect()->route('home');
    // }

    // // Facebook login
    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // // Facebook callback|
    // public function handleFacebookCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();

    //     $this->_registerOrLoginUser($user);

    //     return redirect()->route('home');
    // }



    protected function _registerOrLoginUser($data)
    {

        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->avatar = $data['avatar'];
            $user->save();
        }
        Auth::login($user);
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
    function index()
    {
        return view('admin.user_db', ['title' => 'User', 'active' => 'user']);
    }
    function ajaxGetUser(Request $request)
    {
        $data = $this->userService->ajaxGetUser($request->all());
        return response()->json($data);
    }
    public function create(StoreUserRequest $request)
    {
        $user = $this->userService->create($request->input());
        event(new Registered($user));
        Session::flash('success', 'Register success!');
        return redirect()->route('home');
    }
    // LoginRequest validates login
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
