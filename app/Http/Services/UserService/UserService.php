<?php

namespace App\Http\Services\UserService;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Enums\UserRole;

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
            $user = $this->userRepository->create(
                [
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    // ma hoa mat khau
                    'password' => Hash::make($request['password'])
                ]
            );
            Session::flash('success', 'Thêm danh mục thành công');
            return $user;
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    function ajaxGetUser($requestall)
    {
        $model = $this->userRepository->getAll();
        $recordsTotal = $model->count();
        $datas = $this->userRepository->getAlloffset($requestall['start'], $requestall['length']);
        $datas->map(function ($data) {
            $data->joindate = date( "d/m/Y", strtotime($data->created_at));
            $img = !empty($data->avatar) ? url('/storage/images/users/300/' . $data->avatar) : asset('/template/img/user_default.png');
            $roles = '';
            foreach ($data->roles as $role) {
                $roles .= '<span class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active">' . $role->name . '</span>';
            }
            $data->role_user = $roles;
            $data->img = '<div class="d-flex">
            <div class="userDatatable__imgWrapper d-flex align-items-center">
                <div class="checkbox-group-wrapper">
                    <div class="checkbox-group d-flex">
                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                            <input class="checkbox" type="checkbox" id="check-grp-12">
                            <label for="check-grp-12"></label>
                        </div>
                    </div>
                </div>
                <a href="#" class="profile-image rounded-circle d-block m-0 wh-38" style="background-image:url(' . $img . '); background-size: cover;"></a>
            </div>
            <div class="userDatatable-inline-title">
                <a href="#" class="text-dark fw-500">
                    <h6>' . ($data->last_name . '' . $data->first_name) . '</h6>
                </a>
                <p class="d-block mb-0">
                    ' . $data->address . '
                </p>
            </div>
        </div>';
            $action = '<ul class="orderDatatable_actions justify-content-center mb-0 d-flex flex-wrap">
        <li>
            <a href="#" class="edit edit-button"
                data-id="' . $data->id . '">
                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-edit">
                    <path
                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                    </path>
                    <path
                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                    </path>
                </svg></a>
        </li>';
        if(!$data->hasRole('Admin')){
            $action .= '  <li>
            <a href="#" data-id="' . $data->id . '"
                class="buttonDelete remove">
                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-trash-2">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path
                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                    </path>
                    <line x1="10" y1="11" x2="10"
                        y2="17"></line>
                    <line x1="14" y1="11" x2="14"
                        y2="17"></line>
                </svg></a>
        </li>
    </ul>';
        };
            $data->position = $data->role === 1 ? 'Admin' : 'Member';
            $data->action = $action;
        });
        return ['result' => $datas, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsTotal];
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
