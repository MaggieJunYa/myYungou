<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/14
 * Time: 22:36
 */
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model{
    public function getManyInfo($goods_id){
        $res = $this->alias('g')
            ->join('sp_goods_attr as ga on g.goods_id=ga.goods_id')
            ->join('sp_attribute as a on ga.attr_id = a.attr_id')
            ->where(array('g.goods_id'=>$goods_id,'a.attr_sel'=>'many'))
            ->select();
        return $res;
    }
}