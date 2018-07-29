<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //定义基本属性
    protected $table = 'course';
    //关联profession模型，一对一
    public function rel_profession()
    {
        return $this -> hasOne('App\Model\Profession', 'id', 'profession_id');
    }
}
