<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-15
 * Time: 下午5:00
 */

namespace app\admin\controller;


use app\admin\model\OverTime;
use app\admin\model\Page;
use app\admin\model\User;
use think\Exception;
use think\Loader;
use think\Paginator;

class ManageController extends BaseController
{

    public function show()
    {
        $this->project["current_control"] = "首页";
        $this->project["current_action"] = "加班/调休管理";
        $this->project["menu"]["manage_control"]["control_status"] = "active open";
        $this->project["menu"]["manage_control"]["control_sub"]["manage_show"]["sub_status"] = "active";
        $this->assign("Config", $this->project);

        $param = "";
        $query = "";
        $page = new Page();
        $realName = input("param.realName");
        $vacaType = input("param.vacaType");
        $startTime = input("param.startTime");
        $endTime = input("param.endTime");

        if (!empty($realName)) {
            $param = $param . "&realName=" . $realName;
//            $query["realName"] = $realName;
            $query = "realName='".$realName."'";
        }
        if (!empty($vacaType) && $vacaType != 3) {
            $param = $param . "&vacaType=" . $vacaType;
//            $query["vacaType"] = $vacaType;
            if (!empty($query)) {
                $query = $query . " AND vacaType=" . $vacaType;
            } else {
                $query = "vacaType=" . $vacaType;
            }
        }

        if (!empty($startTime) && !empty($endTime)) {
            $param = $param . "&startTime=" . $startTime . "&endTime=" . $endTime;
            $stime = strtotime($startTime . " 00:00");
            $etime = strtotime($endTime . " 23:59");
            if (!empty($query)) {
                $query = $query . " AND startTime>=" . $stime . " AND endTime<=" . $etime;
            }else{
                $query = "startTime>=" . $stime . " AND endTime<=" . $etime;
            }
        }
        if (empty($query)) {
            $overtimes = OverTime::where("")->order("createTime","desc")->paginate(Page::$PER_PAGE_NUM);
            $page->setTotalDataNum(OverTime::count());
        } else {
            $overtimes = OverTime::where($query)->order("createTime","desc")->paginate(Page::$PER_PAGE_NUM);
            $page->setTotalDataNum(OverTime::where($query)->count());
        }
        $this->assign("overtimes", $overtimes);
        $page->setCurrentPage(Paginator::getCurrentPage());
        $page->setPathUrl(url("Manage/show"));
        $page->setParam($param);
        $page->setRender();
        $this->assign("page", $page);
        return $this->fetch();
    }

    public function add()
    {
        $this->project["current_control"] = "首页";
        $this->project["current_action"] = "加班/调休管理";
        $this->project["menu"]["manage_control"]["control_status"] = "active open";
        $this->project["menu"]["manage_control"]["control_sub"]["manage_add"]["sub_status"] = "active";
        $this->assign("Config", $this->project);

        $users = User::all();
        $this->assign("users", $users);
        return $this->fetch();
    }

    public function addAction()
    {
        $msg = "";
        $errorMsg="";
        $dateMsg="";
        try{
            $realNames = $_POST["realName"];
        }catch (Exception $e){
            $this->error("请至少选择一位同事",null,'',1);
        }
        $vacaType = input("post.vacaType");
        $vacaDate = input("post.vacaDate");
        $startTime = input("post.startTime");
        $endTime = input("post.endTime");
        $reason = input("post.reason");
        $totalTime = input("post.totalTime");
        $overtime = new OverTime();
        $overtime->vacaType = $vacaType;
        if (empty($vacaDate)) {
            return $this->error("请选择日期", null, '', 1);
        }
        $overtime->startTime = strtotime($vacaDate . " " . $startTime . ":00");
        $overtime->endTime = strtotime($vacaDate . " " . $endTime . ":00");
        $overtime->reason = $reason;
//        $overtime->totalTime = ($overtime->endTime - $overtime->startTime) / (60 * 60);
        $overtime->totalTime = $totalTime;
        $overtime->createTime = time();
        $validate = Loader::validate("OverTime");
        if (!$validate->check($overtime)) {
            $this->error($validate->getError(), null, '', 1);
        }
        foreach ($realNames as $key=> $id) {
            $user = User::get(["id" => $id]);

            $overtimes = OverTime::all(["userId"=>$user->id]);
            $olen = sizeof($overtimes);
            for($i=0;$i<$olen;$i++){
                $ot = $overtimes[$i];
                $d1 = date("Y-m-d",$ot->startTime);
                if($d1==$vacaDate && $ot->vacaType==$vacaType){
                    $type = $vacaType==1?"加班":"调休";
                    if(empty($dateMsg)){
                        $dateMsg=$dateMsg."已经存在".$user->realName.$vacaDate.$type."记录";
                    }else{
                        $dateMsg=$dateMsg.";"."已经存在".$user->realName.$vacaDate.$type."记录";
                    }
                    continue 2;
                }
            }

            $overtime->realName = $user->realName;
            if (!$user->overtimes()->save($overtime)) {
               if(empty($errorMsg)){
                   $errorMsg = $errorMsg.$user->realName."添加出错:".$user->getError();
               }else{
                   $errorMsg = $errorMsg.";".realName."添加出错:".$user->getError();
               }
            }
        }
        if(!empty($errorMsg)){
            $msg = $msg.$errorMsg."。";
        }
        if(!empty($dateMsg)){
            $msg = $msg.$dateMsg."。";
        }
        if(empty($msg)){
            $msg = "添加成功";
        }
        return $this->success($msg);

    }

    public function edit($vid)
    {
        $this->project["current_control"] = "首页";
        $this->project["current_action"] = "加班/调休编辑";
        $this->project["menu"]["manage_control"]["control_status"] = "active";
        $this->assign("Config", $this->project);

        $overtime = OverTime::get($vid);
        $this->assign("overtime", $overtime);


        return $this->fetch();
    }

    public function editAction()
    {
        $overtime = OverTime::get(input("post.vid"));
        $overtime->vacaType = input("post.vacaType");
        $vacaDate = input("post.vacaDate");
        $startTime = input("post.startTime");
        $endTime = input("post.endTime");
        if (empty($vacaDate)) {
            return $this->error("请选择日期", null, '', 1);
        }
        $overtime->startTime = strtotime($vacaDate . " " . $startTime . ":00");
        $overtime->endTime = strtotime($vacaDate . " " . $endTime . ":00");
        $overtime->reason = input("post.reason");
        $totalTime = input("post.totalTime");
//        $overtime->totalTime = ($overtime->endTime - $overtime->startTime) / (60 * 60);
        $overtime->totalTime = $totalTime;
        $overtime->createTime = time();
        $validate = Loader::validate("OverTime");
        if (!$validate->check($overtime)) {
            $this->error($validate->getError(), null, '', 1);
        }
        if ($overtime->save()) {
            return $this->success("加班/调休编辑成功", "Manage/show", "", 1);
        } else {
            return $this->error($overtime->getError(), null, '', 1);
        }
    }
} 