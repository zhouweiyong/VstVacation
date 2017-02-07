<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-22
 * Time: 下午3:02
 */

namespace app\admin\validate;


use think\Validate;

class OverTime extends Validate
{
    protected $rule = [
        "vacaType" => "require",
        "startTime" => "require|gt:0",
        "endTime" => "require|gt:0",
        "reason" => "require",
    ];

    protected $message = [
        "vacaType.require" => "请选择类型",
        "startTime.require" => "请选择开始时间",
        "startTime.gt" => "请选择开始时间",
        "endTime.require" => "请选择结束时间",
        "endTime.gt" => "请选择结束时间",
        "reason.require" => "请输入事由",
    ];
}