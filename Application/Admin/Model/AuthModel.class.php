<?php
namespace Admin\Model;
use Think\Model;
class AuthModel extends Model{
    public $arr = array();
    public function cateAuth($pid = 0){
        $infos = $this->where(array('auth_pid'=>$pid))->select();
        if($infos){
            foreach($infos as $v){
                $this->arr[] = $v;
                $this->cateAuth($v['auth_id']);
            }
        }else{
            return false;
        }
        return $this->arr;
    }
}