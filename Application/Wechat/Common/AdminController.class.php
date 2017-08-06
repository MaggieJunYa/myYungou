<?php

namespace Admin\Common;

use Think\Controller;

class AdminController extends Controller{
    //构造方法
    function __construct(){
        //避免覆盖父类构造方法.先执行
        parent::__construct();
        //控制管理员越权访问
        $admin_id = cookie('admin_id');
        $admin_user = cookie('admin_user');
        //当前访问的控制器-操作方法
        //CONTROLLER_NAME:当前控制器的名称
        //ACTION_NAME:当前操作的名称
        $nowAC = CONTROLLER_NAME . '-' . ACTION_NAME;
        //判断用户是否登录
        if (empty($admin_user)) {
            //没有登录
            $allow_auth = "User-userLogin,User-verifyImg";
            if (stripos($allow_auth, $nowAC) === false) {
            //使用js的方式跳转，防止只有一部分页面跳转
                $js = <<<eof
            <script>
            window.top.location.href="/index.php/Admin/User/userLogin";
</script>
eof;
            echo $js;
            }
        }else{
            //用户已经登录
            //通过ID获取对应的角色控制权限
            $allow_AC = D('Manager')->getAuthAc($admin_id)['role_auth_ac'];
            //默认允许的角色权限定义
            $default_AC = "User-userLogin,User-verifyImg,User-userLogout,Index-index,Index-left,Index-right,Index-center,Index-top,Index-down";
            if(stripos($allow_AC,$nowAC) === false&&stripos($default_AC,$nowAC)===false&&$admin_user!='admin'){
                $this->error('很抱歉，您无权访问！',U('Admin/Index/index'),2);die;
            }
        }
    }
}