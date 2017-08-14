<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/11
 * Time: 15:39
 */
namespace Admin\Controller;
use Admin\Common\AdminController;
class MemberController extends AdminController{
    public function showlist(){
        $this->display();
    }
    public function addMemberLevel(){
        if(IS_AJAX){
            $data = I('post.data');
            $res = D('MemberLevel')->add($data);
            if($res){
                echo json_encode(array('status'=>200,'message'=>'会员级别添加成功！'));
            }else{
                echo json_encode(array('status'=>202,'message'=>'会员级别添加失败！'));
            }
        }else{
            $this->display();
        }
    }
    public function memberLevelList(){
        $memberLevelInfo = D('MemberLevel')->getMemberLevelInfo();
        $this->assign('memberLevelInfo',$memberLevelInfo);
        $this->display();
    }
}