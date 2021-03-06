<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PanelController extends Controller
{
    public function index()
    {
        return view('panel.index');
    }

    public function showLoginForm()
    {
        return view('panel.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();
        if(!Hash::check($request->password, $user->password))
            return redirect()->back()->withErrors(['email' => "نام کاربری یا رمز عبور صحیح نمیباشد"]);
        Auth::loginUsingId($user->id);
        return redirect()->to(route('panel.dashboard.index'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to(route('login'));
    }

    public function menu()
    {
        return view('panel.menu');
    }
}
