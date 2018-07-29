<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Input;
use App\Model\Auth;

class AuthController extends Controller
{
    //权限列表
    public function index()
    {
        //查询数据
        //$sql = "SELECT ti.*, t2.auth_name as parent_name FROM auth as t1 LEFT JOIN auth as t2 ON t1.pid = t2.id";
        $data = DB::table('auth as t1') -> select('t1.*', 't2.auth_name as parent_name') -> leftJoin('auth as t2', 't1.pid', '=', 't2.id') -> get();
        //展示视图
        return view('admin.auth.index', compact('data'));
    }
    //添加权限
    public function add()
    {
        //判断请求类型（get or post）
        if(Input::method() == 'POST')
        {
            //post
            //自动验证

            //写入数据
            if(Auth::create(Input::all()))
            {
                $response = ['code' => '0', 'msg' => '添加权限成功！'];
            }else
            {
                $response = ['code' => '1', 'msg' => '添加权限失败！'];
            }
            return response() -> json($response);
        }else
        {
            //get
            //获取顶级权限
            $parent = Auth::where('pid', 0) -> get();
            return view('admin.auth.add', compact('parent'));
        }
    }
}
