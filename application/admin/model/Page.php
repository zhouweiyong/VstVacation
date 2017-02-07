<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-11-17
 * Time: 下午2:42
 */
namespace app\admin\model;

class Page {
    public static $PER_PAGE_NUM = 20;
    private static $SHOW_NUM=7;
    public  $totalDataNum;
    public  $currentFirstNum;
    public  $currentLastNum;
    private $currentPage;
    public  $pageNum;
    private  $pathUrl;
    private $param;
    public  $render;

    /**
     * @param mixed $totalDataNum
     */
    public function setTotalDataNum($totalDataNum)
    {
        $this->totalDataNum = $totalDataNum;
       $this->pageNum =ceil($totalDataNum/Page::$PER_PAGE_NUM);
    }
    /**
     * @param mixed $currentPage
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        $this->currentFirstNum = $currentPage*Page::$PER_PAGE_NUM - Page::$PER_PAGE_NUM+1;
        if($currentPage<$this->pageNum){
            $this->currentLastNum = $currentPage*Page::$PER_PAGE_NUM;
        }else{
            $this->currentLastNum = $this->totalDataNum;
        }
    }

    /**
     * @param mixed $pathUrl
     */
    public function setPathUrl($pathUrl)
    {
        $this->pathUrl = $pathUrl;
    }

    /**
     * @param mixed $param
     */
    public function setParam($param)
    {
        $this->param = $param;
    }



    public function setRender(){
        $temp = "<ul class='pagination'>";
        if($this->currentPage!=1){
//            $temp = $temp."<li><a href='".$this->pathUrl."?page=".($this->currentPage-1).$this->param."'>&laquo;</a></li>";
            $temp = $temp."<li><a href='".$this->pathUrl."?page=1'>&laquo;</a></li>";
        }else{
            $temp = $temp."<li class='disabled'><span>&laquo;</span></li>";
        }
//        for($i = 1;$i <= $this->pageNum;$i++){
//            if($i != $this->currentPage){
//                $temp = $temp."<li><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
//            }else{
//                $temp = $temp."<li class='active'><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
//            }
//        }
        if($this->pageNum<=Page::$SHOW_NUM){
            for($i = 1;$i <= $this->pageNum;$i++){
                if($i != $this->currentPage){
                    $temp = $temp."<li><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                }else{
                    $temp = $temp."<li class='active'><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                }
            }
        }else{
            $halfNum =(Page::$SHOW_NUM-1)/2;
            if($this->currentPage<=$halfNum+1){
                for($i = 1;$i <= Page::$SHOW_NUM;$i++){
                    if($i != $this->currentPage){
                        $temp = $temp."<li><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                    }else{
                        $temp = $temp."<li class='active'><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                    }
                }
            }

            if($this->currentPage>$this->pageNum-Page::$SHOW_NUM+3){
                for($i = $this->pageNum-Page::$SHOW_NUM+1;$i<=$this->pageNum;$i++){
                    if($i != $this->currentPage){
                        $temp = $temp."<li><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                    }else{
                        $temp = $temp."<li class='active'><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                    }
                }
            }

            if($this->currentPage>$halfNum+1 && $this->currentPage<= $this->pageNum-Page::$SHOW_NUM+3){
                $firstNum = $this->currentPage-(Page::$SHOW_NUM-1)/2;
                $endNum = $this->currentPage+(Page::$SHOW_NUM-1)/2;
                for($i = $firstNum;$i <= $endNum;$i++){
                    if($i != $this->currentPage){
                        $temp = $temp."<li><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                    }else{
                        $temp = $temp."<li class='active'><a href='".$this->pathUrl."?page=".($i).$this->param."'>".($i)."</a></li>";
                    }
                }
            }

        }


        if($this->currentPage!=$this->pageNum){
//            $temp = $temp."<li><a href='".$this->pathUrl."?page=".($this->currentPage+1).$this->param."'>&raquo;</a></li>";
            $temp = $temp."<li><a href='".$this->pathUrl."?page=".$this->pageNum."'>&raquo;</a></li>";
        }else{
            $temp = $temp."<li class='disabled'><span>&raquo;</span></li>";
        }

        $temp =  $temp."</ul>";
        $this->render = $temp;
    }
}