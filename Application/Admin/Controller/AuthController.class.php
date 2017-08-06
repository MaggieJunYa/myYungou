<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class AuthController extends AdminController{
    public function showlist(){
        $info = D('Auth')->cateAuth();
        $this->assign('info',$info);
        $this->display();
    }
}
