<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-16
 * Time: 下午6:53
 */

namespace app\admin\controller;


use app\admin\model\User;
use think\Controller;
use think\Session;

class LoginController extends Controller
{

    public function login()
    {
        $this->view->engine->layout(false);
        $tip = input("param.tip");
        if(isset($tip)&&!empty($tip)){
            $this->assign("tip",$tip);
        }



        return $this->fetch();
    }

    public function loginAction(){
        $userName = input("post.userName");
        $password = input("post.password");

        $user = User::get(["userName"=>$userName]);
        if(isset($user)&& $user->password == $password){
            Session::set("realName",$user->realName);
            $this->redirect("Index/index");
        }else{
            $this->redirect("Login/login",["tip"=>"账号或密码错误！"]);
        }
    }

    public function logout(){
        Session::delete("realName");
        $this->redirect("Login/login");
    }

} 