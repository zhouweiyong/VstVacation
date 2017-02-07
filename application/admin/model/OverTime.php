<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-21
 * Time: 上午10:50
 */

namespace app\admin\model;


use think\Model;

class OverTime extends Model
{

    protected $table = "vacation_overtime";

    protected $pk = "id";
    //自动更新时间戳
    protected $autoWriteTimestamp = true;

    //定义时间戳字段
    protected $createTime = 'createTime';
    protected $updateTime = "updateTime";

    public function user()
    {
        return $this->belongsTo("User");
    }
} 