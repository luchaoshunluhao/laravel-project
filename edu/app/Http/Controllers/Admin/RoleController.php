<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Auth;
use Input;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        //查询数据
        $data = Role::all();
        //输出数据
        return view('admin.role.index', compact('data'));
    }
    //角色权限分配
    public function assign()
    {
        //判断请求数据
        if(Input::method() == 'POST')
        {
            //post
            //获取基本数据
            $ids = Input::get('auth_ids');
            $role_id = Input::get('id');
            //提交给模型处理
            $model = new \App\Model\Role();
            //调用模型中自定义的方法去处理数据，并保存在数据库中
            if(false !== $model -> assignAuth($role_id, $ids))
            {
                //成功
                $response = ['code' => 0, 'msg' => '权限分派成功'];
            }else
            {
                //失败
                $response = ['code' => 1, 'msg' => '权限分派失败'];
            }
            return response() -> json($response);
        }else
        {
            //get
            //查询权限的情况
            $parent = Auth::where('pid', '0') ->get();
            $children = Auth::where('pid', '>', '0') -> get();
            //查询当前正在分配权限的角色名称
            $role = Role::find(Input::get('id'));
            return view('admin.role.assign', compact('parent', 'children', 'role'));
        }
    }
}
