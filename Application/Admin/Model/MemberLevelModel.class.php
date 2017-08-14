<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/11
 * Time: 15:45
 */
namespace Admin\Model;
use Think\Model;
class MemberLevelModel extends Model{
    public function getMemberLevelInfo(){
        $count = $this->count();
        $page = new \Think\Page($count,10);
        $show = $page->show();
        $Info = $this->limit($page->firstRow.','.$page->listRows)->where(array('flag'=>'0'))->select();
        return array('page'=>$page,'show'=>$show,'Info'=>$Info);
    }

}