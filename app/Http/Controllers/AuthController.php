<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function register(Request $request)
    {
        dd(Hash::make($request['password']));

        $data = $request->validate([
            'firstName' => 'required|string|min:3|max:255',
            'lastName' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|min:11|max:20',
            'password' => 'required|string|min:6|max:20|confirmed',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['roleId'] = Role::where('name', 'user')->first()->id;
        $data['access_token'] = Str::random(64);

        $this->userModel->create($data);

        return response()->json([
            "success" => "success",
            "token" => $data['access_token']
        ]);
    }

    public function logIn(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|max:20'
        ]);

        $isLogIn = auth()->attempt(['email' => $data['email'], 'password' => $data['password']]);
        // dd($isLogIn);
        if ($isLogIn) {
            $activUser = auth()->user()->userStatus;

            if ($activUser) {
                $access_token = Str::random(64);

                // $userid = auth()->user()->id;
                $userUpdate = $this->userModel->find(auth()->user()->id);
                $userUpdate->update([
                    'access_token' => $access_token
                ]);
                return response()->json([
                    "message" => "success",
                    'token' => $access_token
                ]);
            }
            return response()->json([
                "message" => 'The User Is Blocked',
            ]);
        }
        return response()->json([
            "message" => $isLogIn,
        ]);
    }

    public function logOut(Request $request)
    {
        $access_token = $request->header('access_token');

        $this->userModel->where('access_token', $access_token)->first()->update([
            'access_token' => null
        ]);

        return response()->json([
            "message" => "Logged Out"
        ]);
    }
}
