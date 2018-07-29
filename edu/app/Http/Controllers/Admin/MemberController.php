<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;
use Input;
use DB;

class MemberController extends Controller
{
    //会员列表
    public function index()
    {
        $data = Member::all();
        return view('admin.member.index', compact('data'));
    }
    //用户添加
    public function add()
    {
        //请求类型的判断
        if(Input::method() == 'POST')
        {
            //post
            //自动数据验证
            //入表
            $data = Input::all();
            unset($data['_token']);
            //对密码加密
            $data['password'] = bcrypt($data['password']);
            //$data['avatar'] = '/statics/avatar.jpg';//临时数据
            //去掉webuploader默认追加的file表单项
            unset($data['file']);
            $data['created_at'] = date('Y-m-d H:i:s');
            if(Member::insert($data))
            {
                $response = ['code' => 0, 'msg' => '会员创建成功！'];
            }else
            {
                $response = ['code' => 1, 'msg' => '会员创建失败！'];
            }
            return response() -> json($response);
        }else
        {
            //get
            //获取国家部分的数据
            $country = DB::table('area') -> where('pid', '0') -> get();
            return view('admin.member.add', compact('country'));
        }
    }
    //根据地区id获取其下属的行政区划
    public function getAreaById()
    {
        //获取id
        $id = (int) Input::get('id');
        //获取下属地址
        $data = DB::table('area') ->where('pid', $id) ->get();
        return response() -> json($data);
    }
}
