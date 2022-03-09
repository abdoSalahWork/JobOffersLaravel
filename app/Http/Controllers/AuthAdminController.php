<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{

    public function loginPage()
    {
        return view('aPanel.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $isLogIn = auth()->attempt(['email' => $data['email'], 'password' => $data['password']]);

        if ($isLogIn) {
            return redirect(route('index'));
        }
;
        session()->flash('message', 'Email or Password Invalid');
        return redirect(route('loginPage'));
    }

    public function index()
    {
        if (auth()->user()) {
            $name = auth()->user()->firstName ." ". auth()->user()->lastName;
            return view('aPanel.index',compact('name'));
        }
        return view('aPanel.login');
    }

    public function logOut()
    {
        auth()->logout();
        return redirect(route('loginPage'));
    }

}
