<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->withErrors(['email' => 'このメールアドレスは登録されていません'])->withInput();
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard')->with('success', 'ログインに成功しました！');
        }
        return back()->withErrors(['password' => 'パスワードが間違っています'])->withInput();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login')->with('success', 'ログアウトしました');
    }
}
