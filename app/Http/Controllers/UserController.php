<?php

namespace App\Http\Controllers;

use App\Http\Resources\userResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public $userModel, $roleModel;
    public function __construct(User $user, Role $role)
    {
        $this->userModel = $user;
        $this->roleModel = $role;
    }
    public function getAllUser()
    {
        $roles = $this->roleModel->whereNotIn('name' ,['superAdmin'])->get();
        $users = $this->userModel->whereNotIn('roleId' ,['1'])->with('role')->get();

        return view('aPanel.user.viewUsers', compact(['users', 'roles']));
    }
    public function searchUser(Request $request)
    {
        $roles = $this->roleModel->whereNotIn('name' ,['superAdmin'])->get();
        $users = $this->userModel->where('email','LIKE', '%' . $request->search . '%')->whereNotIn('roleId' ,['1'])->with('role')->get();
        return view('aPanel.user.viewUsers', compact(['users', 'roles']));
    }
    public function updateUser(Request $request, $id)
    {
        $updateUser = $this->userModel->find($id);

        if ($updateUser) {
            $updateUser->roleId = $request->roleId;
            $updateUser->save();
        }
        return redirect(route('admin.getAllUsers'));
    }
    public function activeUser(Request $request,$id)
    {

        $activeUser = $this->userModel->find($id);
        if($activeUser)
        {
            $activeUser->userStatus = $request->activation;
            $activeUser->save();
        }
        return redirect(route('admin.getAllUsers'));
    }

    public function delete($id)
    {
        $deleteUser = $this->userModel->find($id);

        if($deleteUser)
        {
            $deleteUser->delete();
        }
        return redirect(route('admin.getAllUsers'));
    }
}
