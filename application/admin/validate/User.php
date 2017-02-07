<?php
namespace app\admin\validate;
use think\Validate;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-17
 * Time: 上午11:11
 */

class User extends Validate{

    protected $rule=[
        "userName"=>"require",
        "password"=>"require|length:6,10",
        "realName"=>"require",
        "phoneNum"=>"require",
        "phoneNum"=>["regex"=>"/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/i"]
    ];

    protected $message = [
        "userName.require" => "请输入用户名",
        "password.require" => "请输入密码",
        "password.length" => "密码长度为6至10位",
        "realName.require" => "请输入姓名",
        "phoneNum.require" => "请输入手机号",
        "phoneNum.regex" => "请输入正确的手机号",
    ];
} 