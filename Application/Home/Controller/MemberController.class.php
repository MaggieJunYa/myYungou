<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/12
 * Time: 19:16
 */
namespace Home\Controller;

use Think\Controller;

class MemberController extends Controller
{
    //用户登录
    public function login()
    {
        if(IS_POST){
            $username = I('post.username');
            $password = I('post.password');
            $preg = "/^1[34578]\d{9}$/";
            $preg2="/^[\w\-\.]+@[\w\-]+(\.\w+)+$/";
            if(preg_match($preg,$username)){
                //手机注册登录
                $res = D('User')->where(array('user_tel'=>$username))->find();
                if($res){
                    if($res['is_active']=='未激活'){
                        $this->assign('activeError','该用户存在异常，请及时联系管理员！');
                    }else{
                        if($res['password']==md5($password)){
                            //登录成功
                            session('username',$username);
                            $this->redirect('Index/index',2);
                        }else{
                            //登录失败
                            $this->assign('passError','密码错误');
                        }
                    }
                }else{
                    $this->assign('activeError','该用户不存在，请注册！');
                    $this->redirect('register',2);
                }
            }elseif(preg_match($preg2,$username)){
                //邮箱注册登录
                $res = D('User')->where(array('user_email'=>$username))->find();
                if($res){
                    if($res['is_active']=='未激活'){
                        $this->assign('activeError','该用户还未激活，请及时联系管理员！');
                    }else{
                        if($res['password']==md5($password)){
                            //登录成功
                            $nickname = substr(md5($password),15);
                            session('username',$nickname);
                            $this->redirect('Index/index',2);
                        }else{
                            //登录失败
                            $this->assign('passError','密码错误');
                            $this->display();
                        }
                    }
                }else{
                    $this->assign('activeError','该用户不存在，请注册！');
                    $this->redirect('register',2);
                }
            }
        }else{
            $this->display();
        }
    }

    //用户注册
    public function register()
    {
        if (IS_POST) {
            //自动验证
            $res = D('User')->create();
            if (!$res) {
                $error = D('User')->getError();
                $this->assign('error', $error);
                $this->display();
            } else {
                //判断用户是通过邮箱or手机号注册的
                $preg = "/^1[34578]\d{9}$/";
                $preg2 = "/^[\w\-\.]+@[\w\-]+(\.\w+)+$/";
                if (preg_match($preg, $_POST['username'])) {
                    //用户通过手机号注册
                    //跳转至手机验证码验证页面
                    $this->redirect('codeRegister',array('username'=>$_POST['username'],'password'=>$_POST['password']),2);
                    //$this->codeRegister($_POST['username'], $_POST['password']);
                } elseif (preg_match($preg2, $_POST['username'])) {
                    //用户通过邮箱注册
                    //将用户信息存入
                    $this->mailRegister($_POST['username'], $_POST['password']);
                }
            }
        } else {
            $this->display();
        }
    }
    public function codeRegister(){
        $telnum = I('get.username');
        $password = I('get.password');
        if(IS_POST){
            $code = I('post.verifyCode');
            $now = time();
            $data = session('data');
            $nowtime = $data['nowtime'];
            $limitTime = $data['limitTime'] * 60;
            if ($now - $nowtime > $limitTime) {
                //验证码未过期
                if ($code == $data['num']) {
                    //验证码正确
                    $this->assign('info', '验证码正确！');
                    $data['user_tel'] = $telnum;
                    $data['password'] = md5($password);
                    //用户激活
                    $data['is_active'] = '激活';
                    $res = D('User')->add($data);
                    if ($res) {
                        $this->redirect('Member/login', 2);
                    }
                } else {
                    $this->assign('info', '验证码错误！');
                }
            } else {
                $this->assign('info', '验证码已过期！');
            }
        }else{
            session_start();
            $data['num'] = mt_rand(1000, 9999);
            $data['limitTime'] = 3;                 //过期时间 3*60  s
            $data['nowtime'] = time();
            session('data', $data);
            $res = sendTemplateSMS($telnum, array($data['num'], $data['nowtime']));
            $this->display();
        }

    }

    public function mailRegister($emailadd = 0, $password = 0)
    {
        $data['user_email'] = $emailadd;
        $data['password'] = md5($password);
        $data['active_code'] = substr(md5($data['user_email'] . time()), -15);
        $newId = D('User')->add($data);
        if ($newId) {
            $url = "http://www.yungou.com/index.php/Home/Member/Active/user_id/" . $newId . "/active_code/" . $data['active_code'];
            $content = "<p>请点击以下超链接激活账号</p>";
            $content .= "<p><a href='" . $url . "'>" . $url . "</a></p>";
            $res = \sendMail('激活账号邮件', $content, $emailadd);
            //$this->assign('mailInfo', '已将信息发送至邮箱，请登录邮箱激活账号！');
            $this->redirect('showMailSuccess', 2);
        }
    }

    public function showMailSuccess()
    {
        $this->display();
    }

    public function Active()
    {
        $user_id = I('get.user_id');
        $active_code = I('get.active_code');
        $info = D('User')->where(array('user_id' => $user_id, 'active_code' => $active_code))->find();
        if ($info) {
            $save['user_id'] = $user_id;
            $save['active_code'] = '';
            $save['is_active'] = '激活';
            $res = D('User')->save($save);
            if ($res) {
                $this->success('账号激活成功', U('Member/login'), 2);
            } else {
                $this->error('传递参数有问题，请联系管理员', U('Member/register'), 2);
            }
        }
    }
    //退出登录
    public function logout(){
        session('username',null);
        $this->redirect('Member/login',2);
    }
}