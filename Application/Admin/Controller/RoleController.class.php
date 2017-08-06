<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class RoleController extends AdminController{
    public function showlist(){
        $info = D('Role')->getRoles();
        $this->assign('info',$info);
        $this->display();
    }
    public function distribute(){
        $role_id = I('get.role_id');
        $auth_ids = I('post.auth_id');
        if(IS_POST){
            $auth_ids = implode(',',$auth_ids);
            $res = D('Role')->where(array('role_id'=>$role_id))->save(array('role_auth_ids'=>$auth_ids));
            if($res){
                $this->success('分配权限成功！',U('Role/showlist'),3);
            }else{
                $this->error('分配权限失败！',U('Role/showlist'),3);
            }
        }else{
            $roleinfo = D('Role')->find($role_id);
            $admin_user = cookie('admin_user');
            $res = D('Manager')->getAuthInfos($role_id,$admin_user);
            $authInfoA = $res['authInfoA'];
            $authInfoB = $res['authInfoB'];
            $this->assign('authinfoA',$authInfoA);
            $this->assign('authinfoB',$authInfoB);
            $this->assign('roleinfo',$roleinfo);
            $this->display();
        }
    }
}
