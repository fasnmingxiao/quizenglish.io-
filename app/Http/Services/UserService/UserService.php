<?php

namespace App\Http\Services\UserService;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserService
{
    public $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function create($request)
    {
        try {
            $this->userRepository->create(
                [
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    // ma hoa mat khau
                    'password' => Hash::make($request['password'])
                ]
            );
            Session::flash('success', 'Thêm danh mục thành công');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    public function get_reg_today()
    {
        return $this->userRepository->get_reg_today();
    }
    public function updatePass($request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->get('newPassword'));
        $this->userRepository->updatePass($user);
    }
    public function update($request)
    {
        $user = Auth::user();
        $user->birthDay = $request->get('birthDay');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        return $this->userRepository->update($user);
    }
    public function updateAvatar($request)
    {
        $user = Auth::user();
        $user->avatar = $request->get('img');
        return  $this->userRepository->update($user);
    }
    public function get()
    {
        $user_id = Auth::user()->id;
        return $this->userRepository->get($user_id);
    }
    public function get_dashboard()
    {
        return $this->userRepository->get_dashboard();
    }
}
