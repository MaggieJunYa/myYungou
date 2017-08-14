<?php
/**
 * Created by PhpStorm.
 * User: MaggieJun
 * Date: 2017/8/12
 * Time: 20:06
 */
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    //开启批处理验证
    protected $patchValidate = true;
    protected $_validate = array(
        array('username','require','用户名不能为空',1),
        array('password','require','密码不能为空！',1),
        array('password2','require','请填写确认密码！',1),
        array('username','','用户名已经注册',1,'unique',1),
        array('password2','password','两次密码不一致！',1,'confirm'),
    );
}