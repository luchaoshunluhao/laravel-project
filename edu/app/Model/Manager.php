<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//引入trait的空间
use Illuminate\Auth\Authenticatable;

class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //基本定义
    protected $table = 'manager';
    use Authenticatable;
    //关联角色模型(relate：关系)
    public function rel_role()
    {
        //关联关系的返回（一对一）
        return $this -> hasOne('App\Model\Role', 'id', 'role_id');
    }
}
