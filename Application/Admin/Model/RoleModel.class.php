<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model{
    public function getRoles(){
        $count = $this->count();    //查询满足要求的总记录数
        $page = new \Think\Page($count,10);//实例化分布类，传入总记录数和每页显示的记录数
        $show = $page->show();  //分页显示输出
        $Roleinfo = $this->limit($page->firstRow.','.$page->listRows)->select();
        return array('page'=>$page,'show'=>$show,'Roleinfo'=>$Roleinfo);
    }
}
