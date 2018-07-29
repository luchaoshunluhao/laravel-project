<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('member', function($table){
            $table -> increments('id');
            $table -> string('username',20) -> notNull() -> comment('用户名');
            $table -> string('password') -> notNull() -> comment('密码');
            $table -> enum('gender',[1,2,3]) -> nutNull() ->default('1') -> comment('性别');
            $table -> string('mobile',11) -> comment('手机号');
            $table -> string('email',40) -> comment('邮箱');
            $table -> string('avatar') -> comment('头像图片地址');
            $table -> timestamps();
            $table -> rememberToken();
            $table -> enum('type',[1,2]) -> notNull() ->default('1') -> comment('账号类型');
            $table -> enum('status',[1,2]) -> notNull() ->default('2') -> comment('状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('member');
    }
}
