<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/12
 * Time: 1:56
 */
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
    public function getGoodsInfo(){
        $count = $this->count();
        $page = new \Think\Page($count,10);
        $show = $page->show();
        $list = $this->limit($page->firstRow.','.$page->listRows)->where(array('is_del'=>'0'))->select();
        return array('page'=>$page,'show'=>$show,'list'=>$list);
    }
}