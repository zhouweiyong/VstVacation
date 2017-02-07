<?php
namespace app\admin\controller;




use app\admin\model\Page;
use app\admin\model\User;
use think\Paginator;

class IndexController extends BaseController
{

    public function index()
    {
        $this->project["current_control"]="首页";
        $this->project["current_action"]="用户列表";
        $this->project["menu"]["user_control"]["control_status"]="active open";
        $this->project["menu"]["user_control"]["control_sub"]["user_show"]["sub_status"]="active";
        $this->assign("Config",$this->project);
//        dump(url("User/add"));
        $realName = input("param.realName");
        $page = new Page();
        $param = "";
        if(isset($realName)){
            $param = "&realName=".$realName;
        }

        if(empty($param)){
            $userList = User::where("")->order("createTime","desc")->paginate(Page::$PER_PAGE_NUM);
            $page->setTotalDataNum(User::count());
        }else{
            $userList = User::where("realName",$realName)->order("createTime","desc")->paginate(Page::$PER_PAGE_NUM);
            $page->setTotalDataNum(User::where("realName",$realName)->count());
        }
        $page->setCurrentPage(Paginator::getCurrentPage());
        $this->assign("userList",$userList);
        $page->setPathUrl(url("Index/index"));
        $page->setParam($param);
        $page->setRender();
        $this->assign("page",$page);

        return $this->fetch();

    }

    public function query(){

    }
}
