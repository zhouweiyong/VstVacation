<?php
namespace app\admin\model;

use think\Model;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-17
 * Time: 上午10:23
 */

class User extends Model
{
    protected $table = "vacation_user";

    protected $pk = "id";
    //自动更新时间戳
    protected $autoWriteTimestamp = true;

    //定义时间戳字段
    protected $createTime = 'createTime';
    protected $updateTime  =  "lastTime";
//    protected $field = [
//        "id" => "int",
//        "userName" => "char",
//        "password" => "varchar",
//        "realName" => "char",
//        "phoneNum" => "char",
//        "createTime" => "int",
//        "lastTime" => "int"
//    ];

    public function overtimes(){
        return $this->hasMany("OverTime","userId");
    }
} 