<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Auth;
use Input;


class IndexController extends Controller
{
    //首页方法-index
    public function index()
    {
        $parent = Auth::where('pid', '0') ->get();
        $children = Auth::where('pid', '>', '0') -> get();
        return view('/admin/index/index', compact('parent', 'children'));
    }
        //首页方法-welcome
    public function welcome()
    {
        return view('/admin/index/welcome');
    }
    //退出
    public function logout()
    {
        //清除session
        Auth::guard('admin') -> logout();
        //跳转
        return redirect(route('login'));
    }
}
