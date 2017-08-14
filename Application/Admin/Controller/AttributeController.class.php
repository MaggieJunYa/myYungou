<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/10
 * Time: 1:20
 */
namespace Admin\Controller;
use Admin\Common\AdminController;
class AttributeController extends AdminController{
    public function showlist(){
        $typeInfo = D('Type')->select();
        $this->assign('typeInfo',$typeInfo);
        $Info = D('Attribute')->select();
        $this->assign('Info',$Info);
        $this->display();
    }
    public function getAttrByTypeInfo(){
        $type_id = I('post.type_id');
        $res = D('Attribute')->getAttrInfo($type_id);
        $info = array();
        foreach($res as $row){
            $info[]=$row;
        }
        echo json_encode(array('info'=>$info));
    }
    //添加属性
    public function addAttribute(){
        if(IS_POST){
            $attrInfo = I('post.attrInfo');
            $res = D('Attribute')->add($attrInfo);
            if($res){
                echo json_encode(array('status'=>200,'message'=>'属性添加成功'));
            }else{
                echo json_encode(array('status'=>202,'message'=>'属性添加失败'));
            }
        }else{
            $typeInfo = D('Type')->select();
            $this->assign('typeInfo',$typeInfo);
            $this->display();
        }
    }
}