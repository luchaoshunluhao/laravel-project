<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建数据表
        Schema::create('role', function(Blueprint $table){
            //设计相关字段
            $table -> increments('id');
            $table -> string('role_name', 20) -> notnull() -> comment('角色名称');
            $table -> text('auth_ids') -> nullable() -> comment('角色对应的权限id集合');
            $table -> text('auth_ac') -> nullable() -> comment('控制器与方法名称的集合');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除数据表
        Schema::dropIfExists('role');
    }
}
