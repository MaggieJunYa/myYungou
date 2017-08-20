<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/14
 * Time: 15:25
 */
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller{
    public function showlist(){
        $goodsInfo = D('Goods')->select();
        foreach($goodsInfo as $k=>$v){
            $v['goods_small_logo'] = substr($v['goods_small_logo'],1);
            $goodsInfo[$k]['goods_small_logo'] = $v['goods_small_logo'];
        }
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }
    public function detail(){
        $goods_id = I('get.goods_id');
        $goodsInfo = D('Goods')->where(array('goods_id'=>$goods_id))->find();
        $goodsInfo['goods_big_logo'] = substr($goodsInfo['goods_big_logo'],1);
        $manyinfo = D('Goods')->getManyInfo($goods_id);
        foreach($manyinfo as $k=>$v){
            $manyinfo[$k]['attr_vals'] = explode('|',$v['attr_vals']);
        }
        $this->assign('manyinfo',$manyinfo);
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }
}