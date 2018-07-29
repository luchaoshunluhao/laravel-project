<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Live;
use App\Model\Profession;

class IndexController extends Controller
{
    //首页
    public function index()
    {
        //查询直播列表
        $live = Live::where('status', '1') -> orderBy('sort', 'desc') -> get();
        //查询专业课程列表
        $profession = Profession::orderBy('sort', 'desc') -> get();
        //处理一下直播状态
        foreach($live as $key => $val)
        {
            //$val是一个对象
            #直播未开始的状态
            if( time() < $val -> begin_at )
            {
                $val -> live_status = '直播未开始';
            }
            #直播已结束
            if( time() > $val -> end_at )
            {
                $val -> live_status = '直播已结束';
            }
            #直播中
            if( time() >= $val -> begin_at && time() <= $val -> end_at )
            {
                $val -> live_status = '直播中';
            }
        }
        #展示视图
        return view('home.index.index', compact('live', 'profession'));
    }
}
