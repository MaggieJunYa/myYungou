<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>后台登录页面</title>
<link rel="stylesheet" type="text/css" href="<?php echo C('AD_CSS');?>style.css">
</head>
<body>

<script src="<?php echo C('AD_JS');?>jquery-1.7.2.min.js" type="text/javascript"></script>

<div class="logo_box">
	<h3>云购物后台登录</h3>
	<form action="" name="" method="post">
		<div class="input_outer">
			<span class="u_user"></span>
			<input name="username" class="text" onFocus=" if(this.value=='输入ID或用户名登录') this.value=''" onBlur="if(this.value=='') this.value='输入ID或用户名登录'" value="输入ID或用户名登录" style="color: #FFFFFF !important" type="text">
		</div>
		<div style="color:#f00;margin-left:15px;"><?php echo ((isset($usererror) && ($usererror !== ""))?($usererror):""); ?></div>
		<div class="input_outer">
			<span class="us_uer"></span>
			<label class="l-login login_password" style="color: rgb(255, 255, 255);display: block;">输入密码</label>
			<input name="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;" onFocus="$('.login_password').hide()" onBlur="if(this.value=='') $('.login_password').show()" value="" type="password">
		</div><div style="color:#f00;margin-left:15px;"><?php echo ((isset($passerror) && ($passerror !== ""))?($passerror):""); ?></div>
		<input name="savesid" value="0" id="check-box" class="checkbox" type="checkbox"><span>记住用户名</span>
		<div ><a class="act-but submit" href="javascript:;" style="color: #FFFFFF"><input type="submit" name="" value="登录"></a></div>
	</form>
</div>

</body>
</html>