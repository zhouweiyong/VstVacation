<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-15
 * Time: 下午5:01
 */

namespace app\admin\controller;


use app\admin\model\OverTime;
use app\admin\model\Page;
use app\admin\model\Statistics;
use app\admin\model\User;

class StatisticsController extends BaseController
{

    public function index()
    {

        $this->project["current_control"] = "加班统计";
        $this->project["current_action"] = "加班统计";
        $this->project["menu"]["statistics_control"]["control_status"] = "active";
        $this->assign("Config", $this->project);

        $page = new Page();
        $param ="";
        $realName = input("param.realName");
        $pageNum = input("param.page");
        if(!isset($pageNum)||empty($pageNum)){
            $pageNum = 1;
        }
        if(empty($realName)){
            $users = User::all();
        }else{
            $users = User::all(["realName"=>$realName]);
            $param="&realName=".$realName;
        }
        $ucount = sizeof($users);
        $contents = array();
        $index = 0;
        for($j = 0; $j <$ucount;$j++){
            $user = $users[$j];
            $overtimes = OverTime::all(["userId"=>$user->id]);
            $ocount = sizeof($overtimes);
            if($ocount==0)continue;
            $statistics = new Statistics();
            $statistics->id = ++$index;
            $statistics->realName = $user->realName;
            $jTime=0;//加班总时长
            $tTime=0;//调休总时长
            for($i=0;$i<$ocount;$i++){
                $overtime = $overtimes[$i];
                if($overtime->vacaType==1){
                    $jTime+=$overtime->totalTime;
                }else{
                    $tTime+=$overtime->totalTime;
                }
            }
            $statistics->jTime = $jTime;
            $statistics->tTime=$tTime;
            $statistics->remainTime=$jTime-$tTime;
            $contents[] = $statistics;
        }
        $page->setTotalDataNum($index);
        $pCon = array_slice($contents,$pageNum*Page::$PER_PAGE_NUM-Page::$PER_PAGE_NUM,$pageNum*Page::$PER_PAGE_NUM);
        $page->setCurrentPage($pageNum);
        $page->setPathUrl(url('Statistics/index'));
        $page->setParam($param);
        $page->setRender();
        $this->assign("page",$page);
        $this->assign("contents",$pCon);

        return $this->fetch();

    }

} 