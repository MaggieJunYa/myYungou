<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class IndexController extends AdminController {
    public function index(){
        $this->display();
    }
    public function top(){
        $this->display();
    }
    public function left(){
        //权限信息
        $admin_id = cookie('admin_id');
        $admin_user=cookie('admin_user');
        $res = D('Manager')->getAuthInfos($admin_id,$admin_user);
        $authInfoA = $res['authInfoA'];
        $authInfoB = $res['authInfoB'];
        $this->assign('authInfoA',$authInfoA);
        $this->assign('authInfoB',$authInfoB);
        $this->display();
    }
    public function right(){
        $this->display();
    }
}