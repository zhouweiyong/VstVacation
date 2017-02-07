<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-16
 * Time: 下午6:01
 */

namespace app\admin\controller;


use app\admin\model\User;
use think\Loader;

class UserController extends BaseController{

    public function add(){
        $this->project["current_control"]="首页";
        $this->project["current_action"]="添加用户";
        $this->project["menu"]["user_control"]["control_status"]="active open";
        $this->project["menu"]["user_control"]["control_sub"]["user_add"]["sub_status"]="active";
        $this->assign("Config",$this->project);
        return $this->fetch();
    }

    public function createUser(){
        $user = new User();
        $user->createTime = time();
        if ($user->validate(true)->save(input("post."))){
            $this->success("用户添加成功！",null,'',2);
        }else{
            $this->error($user->getError(),null,'',1);
        }
    }

    public function edit($userId){
        $this->project["current_control"]="首页";
        $this->project["current_action"]="编辑用户";
        $this->project["menu"]["user_control"]["control_status"]="active";
        $this->assign("Config",$this->project);

        $user = User::get($userId);
        $this->assign("user",$user);

        return $this->fetch();
    }

    public function editAciton(){
        $userId = input("post.id");
        $user = User::get($userId);
        $validate = Loader::validate("user");
        $user->userName = input("post.userName");
        $user->password = input("post.password");
        $user->realName = input("post.realName");
        $user->phoneNum = input("post.phoneNum");
        if(!$validate->check($user)){
            $this->error($validate->getError(),null,'',1);
        }
        if($user->save()){
            $this->success("用户编辑成功！","Index/index",'',2);
        }else{
            $this->error($user->getError(),null,'',1);
        }
    }

} 