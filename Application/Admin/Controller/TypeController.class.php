<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/10
 * Time: 0:56
 */
namespace Admin\Controller;
use Admin\Common\AdminController;
class TypeController extends AdminController{
    public function showlist(){
        $Info = D('Type')->getTypeInfo();
        $this->assign('Info',$Info);
        $this->display();
    }
    //添加商品类型
    public function addType(){
        if(IS_AJAX){
            $data = array();
            $type_name=I('post.type_name');
            $data['type_name']=$type_name;
            $res = D('Type')->add($data);
            if($res){
                echo json_encode(array('status'=>200,'message'=>'类型添加成功'));
            }else{
                echo json_encode(array('status'=>202,'message'=>'类型添加失败'));
            }
        }else{
            $this->display();
        }
    }
    //修改商品类型
    public function updType(){
        if(IS_AJAX){
            $data = I('post.data');
            $type_id = $data['type_id'];
            $type_name=$data['type_name'];
            $res = D('Type')->where(array('type_id'=>$type_id))->save(array('type_name'=>$type_name));
            if($res){
                echo json_encode(array('status'=>200,'message'=>'类型修改成功'));
            }else{
                echo json_encode(array('status'=>202,'message'=>'类型修改失败'));
            }
        }else{
            $type_id = I('get.type_id');
            $type=D('Type')->where(array('type_id'=>$type_id))->find();
            $this->assign('type',$type);
            $this->display();
        }
    }
    //删除商品类型
    public function delType(){
        $type_id = I('post.typeId');
        $res = D('Type')->where(array('type_id'=>$type_id))->save(array('flag'=>'1'));
        if(res){
            echo json_encode(array('status'=>200,'message'=>'类型删除成功'));
        }else{
            echo json_encode(array('status'=>200,'message'=>'类型删除失败'));
        }
    }
}