<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/10
 * Time: 0:29
 */
namespace Admin\Controller;
use Admin\Common\AdminController;
class GoodsController extends AdminController{
    //展示商品
    public function showlist(){
        //echo (U('addGoods'));die;
        $info = D('Goods')->getGoodsInfo();
        foreach($info['list'] as $k=>$v){
            $v['goods_small_logo'] = substr($v['goods_small_logo'],1);
            $info['list'][$k]['goods_small_logo']=$v['goods_small_logo'];
        }
        $this->assign('info',$info);
        $this->display();
    }
    //添加商品
    public function addGoods(){
        if(IS_POST){
            $this->dealLogo();
            $info = I('post.');
            $info['add_time'] = $info['upd_time']=time();
            $info['goods_introduce']=\fangXSS($info['goods_introduce']);//防XSS（跨站脚本）攻击
            $res = D('Goods')->add($info);
            if($res){
                $this->deal_pics($res);         //处理商品相册图片
                $this->deal_attr($res);             //处理属性信息
                $this->success('添加成功！', U('showlist'), 2);
            }else{
                $this->error('添加失败！', U('showlist'), 2);
            }
        }else{
            $typeInfo = D('Type')->select();
            $memberInfo = D('MemberLevel')->select();
            $this->assign('typeInfo',$typeInfo);
            $this->assign('memberInfo',$memberInfo);
            $this->display();
        }
    }
    //处理LOGO图片 goods_id为0表示新增，非0表示修改
    //对于要修改的图片，需将原来的图片地址删除
    public function dealLogo($goods_id=0){
        if($_FILES['goods_logo']['error']==0){
            if($goods_id!=0){
                //修改时，要将原图地址删除
                $goodsInfo = D('Goods')->find($goods_id);
                if(file_exists($goodsInfo['goods_big_logo'])){
                    unlink($goodsInfo['goods_big_logo']);
                }
                if(file_exists($goodsInfo['goods_small_logo'])){
                    unlink($goodsInfo['goods_small_logo']);
                }
            }
            //配置图片上传路径
            $cfg = array(
                'rootPath'=>'./Public/Uploads/logo/',
            );
            $upload = new \Think\Upload($cfg);
            $z = $upload->uploadOne($_FILES['goods_logo']);
            $_POST['goods_big_logo'] = $upload->rootPath . $z['savepath'] . $z['savename'];
            //缩略图
            $im = new \Think\Image();           //创建对象
            $im->open($_POST['goods_big_logo']);//打开原图
            $im->thumb(130,130,6);              //设置缩略图处理信息
            $smallPathName = $upload->rootPath.$z['savepath'].'small_'.$z['savename'];
            $im->save($smallPathName);          //保存到服务器路径
            $_POST['goods_small_logo'] = $smallPathName;
        }
    }

    //处理商品相册
    public function deal_pics($goods_id){
        //判断是否有上传相册
        $pics = false;
        foreach($_FILES['goods_pics']['error'] as $v){
            if($v===0){
                $pics = true;
                break;
            }
        }
        if($pics==true){
            //处理上传的相册
            $cfg = array(
                'rootPath'=>'./Public/Uploads/pics',
            );
            $upload = new \Think\Upload($cfg);
            $z = $upload->upload(array($_FILES['goods_pics']));
            $im = new \Think\Image();
            foreach($z as $k => $v){
                $native_pics = $upload->rootPath.$v['savepath'].$v['savename'];
                //原图
                $im->open($native_pics);
                $im->thumb(800,800,6);
                $pics_big = $upload->rootPath.$v['savepath'].'big_'.$v['savename'];
                $im->save($pics_big);
                $im->thumb(350,350,6);
                $pics_mid = $upload->rootPath.$v['savepath'].'mid_'.$v['savename'];
                $im->save($pics_mid);
                $im->thumb(50,50,6);
                $pics_sma = $upload->rooPath.$v['savepath'].'sma_'.$v['savename'];
                $im->save($pics_sma);

                unlink($native_pics);
                $arr = array(
                   'goods_id'=>$goods_id,
                    'pics_big'=>$pics_big,
                    'pics_mid'=>$pics_mid,
                    'pics_sma'=>$pics_sma
                );
                D('GoodsPics')->add($arr);
            }
        }
    }

    //处理属性信息
    public function deal_attr($goods_id){
        D('GoodsAttr')->where(array('goods_id'=>$goods_id))->delete();
        foreach($_POST['attr_info'] as $k=>$v){
            foreach($v as $vv){
                if(!empty($vv)) {
                    $attr['goods_id'] = $goods_id;
                    $attr['attr_id'] = $k;
                    $attr['attr_value'] = $vv;
                    D('GoodsAttr')->add($attr);
                }
            }
        }
    }
    //更改商品数据
    public function updGoods(){
        $goodsId = I('get.goods_id');
        if(IS_POST){
            $res = $this->dealLogo($goodsId);
            echo $res;die;
            $this->deal_pics($goodsId);
            $data['goods_id'] = $goodsId;
            $data['goods_introduce'] = \fangXSS($_POST['goods_introduce']);
            $data['upd_time'] = time();     //更新修改时间
            if($res = D('Goods')->save($data)){
                $this->success("修改成功",U('showlist'),2);
            }else{
                $this->success("修改失败",U('showlist'),2);
            }
        }else{
            $info = D('Goods')->find($goodsId);
            $this->assign('info',$info);
            $this->display();
        }
    }


}