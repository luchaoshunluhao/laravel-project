<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //定义基本属性
    protected $table = 'lesson';
    //关联course模型，一对一
    public function rel_course()
    {
        return $this ->hasOne('App\Model\Course', 'id', 'course_id');
    }
}
