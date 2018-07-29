<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PublicController extends Controller
{
    //展示登录页面
    public function login()
    {
        return view('admin.public.login');
    }
    //登录验证方法
    public function check(Request $request)
    {
        //开始自动验证
        $this -> validate($request, [
            //验证规则'字段name值’ => '规则1|规则2...'
            'username'      => 'required|min:3|max:20',
            'password'      => 'required|min:6',
//            'captcha'       => 'required|size:5|captcha'
        ], [
            //针对没有翻译的错误提示
//            'captcha.required'  => '验证码不能为空',
//            'captcha.size'      => '验证码的长度必须是5',
//            'captcha.captcha'   => '验证码错误'
        ]);
        //身份合法性验证
        $data = $request -> only(['username', 'password']);
        $data['status'] = '2'; //2表示状态为正常的账号
        //Auth认证
        if(Auth::guard('admin') -> attempt($data, $request -> get('online')))
        {
            return redirect(route('dashboard'));
        }else
        {
            return redirect(route('login')) -> withErrors(['error' => '用户名或密码错误']);
        }
    }
}
