<?php
namespace Admin\Model;
use Think\Model;
class ManagerModel extends Model{
    function getAuthAc($id){
        $infos = $this->alias('m')
        ->join('__ROLE__ as r on m.role_id=r.role_id')
        ->where(array('m.mg_id'=>$id))
        ->find();
        return $infos;
    }
    function getAuthInfos($id,$name){
        if($name!='admin'){
            //不是超级管理员
            //根据id联表查询
            $ids = $this->alias('m')
            ->join('__ROLE__ as r on m.role_id=r.role_id')
            ->field('role_auth_ids')
            ->where(array('m.mg_id'=>$id))
            ->find();
            $authInfoA = D('Auth')->where(array('auth_level'=>'0','auth_id'=>array('in',$ids)))->select();
            $authInfoB = D('Auth')->where(array('auth_level'=>'1','auth_id'=>array('in',$ids)))->select();
        }else{
            //是超级管理员
            $authInfoA = D('Auth')->where(array('auth_level'=>'0'))->select();
            $authInfoB = D('Auth')->where(array('auth_level'=>'1'))->select();
        }
        return ['authInfoA'=>$authInfoA,'authInfoB'=>$authInfoB];
    }
}
