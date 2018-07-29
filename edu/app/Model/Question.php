<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //定义基本属性
    protected $table = 'question';
    //定义模型的关联关系
    public function rel_paper()
    {
        //关系：一对一
        return $this -> hasOne('App\Model\Paper', 'id', 'paper_id');
    }
}
