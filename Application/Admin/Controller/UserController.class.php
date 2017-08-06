<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class UserController extends AdminController {
    public function userLogin(){
        if(IS_POST){
            $username = I('post.username');
            $password = I('post.password');
            $savesid = I('post.savesid');
            $usererror = '';
            $passerror = '';
            $res = D('Manager')->field('mg_id,mg_name,mg_pwd')->where(array('mg_name'=>$username))->select();
            if($res){
                //用户名存在
                if($res[0]['mg_pwd']!=md5($password)){
                    //密码不正确
                    $passerror = '密码不正确！';
                }else{
                    //密码正确
                    cookie('admin_id',$res[0]['mg_id']);
                    cookie('admin_user',$username);
                    //session('admin_id',$res[0]['mg_id']);
                    //session('admin_user',$username);
                    //如果选择记住用户名，则将用户名及密码加入会话，一小时内无需登录
                    if($savesid=='0'){
                        setcookie('admin_id',$res[0]['mg_id'],time()+3600,'/');
                        setcookie('admin_user',$username,time()+3600,'/');
                    }
                    $this->redirect('Index/index');
                }
            }else{
                //用户名不存在
                $usererror = '用户名不存在！';
            }
            $this->assign('usererror',$usererror);
            $this->assign('passerror',$passerror);
            $this->display();
        }elseif(cookie('admin_id')){
            $this->redirect('Index/index');
        }else{
            $this->display();
        }
     }
     public function userLogout(){
        cookie('admin_id',null);
        cookie('admin_user',null);
        $this->redirect('User/userLogin');
     }
 }