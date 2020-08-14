<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 用户
 */
class UsersController extends Controller
{

    // 注册页面
    public function create()
    {
        return view('users.create');
    }

    // 展示用户信息页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // 创建用户
    public function store(Request $request)
    {
        // 验证
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        // 创建用户
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // 登录
        Auth::login($user);

        // 成功信息
        session()->flush('success', '欢迎，您将在这里开启一段新的旅程');

        // 重定向到用户展示页面
        return redirect()->route('users.show', [$user]);
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '退出成功');
        return redirect('login');
    }
}
