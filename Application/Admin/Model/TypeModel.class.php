<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/10
 * Time: 11:31
 */
namespace Admin\Model;
use Think\Model;
class TypeModel extends Model{
    public function getTypeInfo(){
        $count = $this->count();
        $page = new \Think\Page($count,10);
        $show = $page->show();
        $typeInfo = $this->limit($page->firstRow.','.$page->listRows)->where(array('flag'=>'0'))->select();
        return array('page'=>$page,'show'=>$show,'typeInfo'=>$typeInfo);
    }
}