<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //执行数据表的填充
        //生成faker实例
        $faker = \Faker\Factory::create('zh_CN');
        //生成100条数据
        $data = [];
        for($i = 0; $i < 100; $i++)
        {
        	$data[] = [
        		'username' 		=> $faker -> userName,
        		'password' 		=> bcrypt('123456'),
        		'gender'		=> rand(1, 3),
        		'mobile'		=> $faker -> PhoneNumber,
        		'email'			=> $faker -> email,
        		'role_id'		=> rand(1, 6),
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'status'		=> rand(1, 2)
        	];
        }
        //写入数据表
        DB::table('manager') -> insert($data);
    }
}
