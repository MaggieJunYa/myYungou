<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class AuthController extends AdminController{
    //展示权限
    public function showlist(){
        $info = D('Auth')->cateAuth();
        $this->assign('info',$info);
        $this->display();
    }
    //增加权限
    public function addAuth(){
        if(IS_POST){
            $authInfo = I('post.');
            if($authInfo['auth_pid']==0){
                $authInfo['auth_level']=0;
            }else{
                $authInfo['auth_level']=1;
            }
            $res = D('Auth')->add($authInfo);
            if($res){
                echo json_encode(array('status'=>200,'message'=>'权限添加成功！'));
            }else{
                echo json_encode(array('status'=>202,'message'=>'权限添加失败！'));
            }
        }else{
            $pAuth = D('Auth')->getPauthes();
            $this->assign('pAuth',$pAuth);
            $this->display();
        }
    }
    //修改权限内容
    public function updAuth(){
        if(IS_POST){
            $authInfo = I('post.authInfo');
            //echo json_encode(array('status'=>$authInfo['auth_id']));die;
            if($authInfo['auth_pid']==0){
                $authInfo['auth_level']=0;
            }else{
                $authInfo['auth_level']=1;
            }
            $res = D('Auth')->where(array('auth_id'=>$authInfo['auth_id']))->save($authInfo);
            if($res){
                echo json_encode(array('status'=>200,'message'=>'权限修改成功！'));
            }else{
                echo json_encode(array('status'=>202,'message'=>'权限修改失败！'));
            }
        }else{
            $auth_id = I('get.auth_id');
            $authInfo = D('auth')->where(array('auth_id'=>$auth_id))->find();
            $allAuth = D('auth')->where(array('auth_pid'=>0))->select();
            $this->assign('allAuth',$allAuth);
            $this->assign('authInfo',$authInfo);
            $this->display();
        }
    }
    //删除权限
    public function delAuth(){
        $auth_id = I('post.auth_id');
        $info = D('auth')->where(array('auth_id'=>$auth_id))->field('auth_pid')->find();
        if($info[0]['auth_pid']!=0){
            $res = D('auth')->where(array('auth_id'=>$auth_id))->save(array('flag'=>'1'));
            if($res){
                echo json_encode(array('status'=>200,'message'=>'权限删除成功！'));
            }else{
                echo json_encode(array('status'=>202,'message'=>'权限删除失败！'));
            }
        }else{
            echo json_encode(array('status'=>204,'message'=>'该权限下仍有子权限!'));
        }
    }
}
