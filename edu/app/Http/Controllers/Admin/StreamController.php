<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Stream;
use GuzzleHttp\Client;
use Input;

class StreamController extends Controller {
	//流列表
	public function index() {
		//获取数据
		$data = Stream::orderBy('sort', 'desc')->get();
		//展示视图，传递参数
		return view('admin.stream.index', compact('data'));
	}

	public function add() {
		if (Input::method() == 'POST') {
			//post，负责表单数据提交和七牛数据的同步
			$data = Input::except(['_token']);
			//生成七牛token
			//定义变量
			$method = "POST";
			$path = "/v2/hubs/education-zet/streams";
			$host = "pili.qiniuapi.com";
			$contentType = "application/json";
			$body = json_encode(['key' => $data['stream_name']]);
			$str = "$method $path\nHost: $host\nContent-Type: $contentType\n\n$body";
			#实例化七牛SDK其中的Auth类
			$auth = new \Qiniu\Auth(config('filesystems.disks.qiniu.access_key'), config('filesystems.disks.qiniu.secret_key'));
			//签名，生成七牛token
			$qiniuToken = "Qiniu " . $auth->sign($str);
			#开始请求
			$client = new Client([
				//基础地址用于进行相对路径请求的
				'base_uri' => "http://$host",
			]);
			//开始请求
			$res = $client->post($path, [
				//请求头和请求体
				'headers' => [
					'Authorization' => $qiniuToken,
					'Content-Type' => $contentType,
				],
				'body' => $body,
			]);
			#判断相应是否成功
			if ($res->getStatusCode() == '200') {
				//进行数据入表
				$data['permited_at'] = (int) strtotime($data['permited_at']);
				//写入数据
				if (Stream::insert($data)) {
					//提示成功
					$response = ['code' => '0', 'msg' => '添加流成功！'];
				} else {
					//提示失败
					$response = ['code' => '1', 'msg' => '添加流失败！'];
				}
			} else {
				//状态码不是200
				$response = ['code' => '2', 'msg' => '接口调用失败!'];
			}

			return response()->json($response);
		} else {
			//get
			return view('admin.stream.add');
		}
	}
}
