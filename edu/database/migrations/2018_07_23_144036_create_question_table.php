<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('question', function($table){
            $table -> increments('id');
            $table -> string('question') -> notNull() -> commit('题干');
            $table -> tinyInteger('paper_id') -> notNull() -> commit('试卷id');
            $table -> tinyInteger('score') -> notNull() ->default(2) -> commit('题目分值');
            $table -> string('options') -> notNull() -> commit('选项');
            $table -> string('answer',1) -> notNull() -> commit('答案');
            $table -> string('remark') -> commit('备注');
            $table -> timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删表
        Schema::dropIfExists('question');
    }
}
