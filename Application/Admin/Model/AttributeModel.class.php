<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/10
 * Time: 11:20
 */
namespace Admin\Model;
use Think\Model;
class AttributeModel extends Model{
    public function getAttrInfo($type_id){
        $res = $this->alias('a')
            ->join('sp_type as t on a.type_id=t.type_id')
            ->where(array('a.type_id'=>$type_id))
            ->select();
        return $res;
    }
}