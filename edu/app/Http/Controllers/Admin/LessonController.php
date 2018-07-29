<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Lesson;

class LessonController extends Controller
{
    //列表
    public function index()
    {
       // 获取数据
        $data = Lesson::orderBy('sort', 'desc') -> get();
       // 展示视图
        return view('admin.lesson.index', compact('data'));
    }
    //
    public function play(Request $request)
    {
        //获取播放视频的id
        $id = (int) $request -> get('id');
        //取出路径
        $path = Lesson::where('id', $id) -> value('video_addr');
        //判断
        if($path)
        {
            //播放
            return "<video src='$path' controls='controls' width='95%'></video>";
        }else
        {
            //未找到视频
            return response() -> json(['err' => '1', 'msg' => '视频未找到']);
        }
    }
}
