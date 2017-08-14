<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="<?php echo C('AD_JS');?>jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo C('AD_JS');?>layer.js"></script>
    <title>添加会员级别</title>

    <style type="text/css">
        <!--
        body {
            margin-left: 3px;
            margin-top: 0px;
            margin-right: 3px;
            margin-bottom: 0px;
        }
        .STYLE1 {
            color: #e1e2e3;
            font-size: 12px;
        }
        .STYLE6 {color: #000000; font-size: 12; }
        .STYLE10 {color: #000000; font-size: 12px; }
        .STYLE19 {
            color: #344b50;
            font-size: 12px;
        }
        .STYLE21 {
            font-size: 12px;
            color: #3b6375;
        }
        .STYLE22 {
            font-size: 12px;
            color: #295568;
        }
        a:link{
            color:#e1e2e3; text-decoration:none;
        }
        a:visited{
            color:#e1e2e3; text-decoration:none;
        }
        -->
        #tabbar-div {
            background: #80bdcb none repeat scroll 0 0;
            height: 22px;
            padding-left: 10px;
            padding-top: 1px;
            margin-bottom: 3px;
        }
        #tabbar-div p { margin: 2px 0 0;font-size:12px;
        }
        .tab-front {
            background: #bbdde5 none repeat scroll 0 0;
            border-right: 2px solid #278296;
            cursor: pointer;
            font-weight: bold;
            line-height: 20px;
            padding: 4px 15px 4px 18px;
        }
        .tab-back {
            border-right: 1px solid #fff;
            color: #fff; cursor: pointer;line-height: 20px;
            padding: 4px 15px 4px 18px;
        }
    </style>
</head>

<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 会员管理 -> 添加会员级别</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
            <a href="<?php echo U('showlist');?>">返回</a>   &nbsp; </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td>
            <form action="" method="post" enctype="multipart/form-data">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="general-tab-show" >
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6">
                            <div align="right">
                                <span class="STYLE19">会员名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="level_name" id="level_name" />

                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6">
                            <div align="right">
                                <span class="STYLE19">折扣率：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="level_rate" id="level_rate" />
                            <span style="color: red">100=10折，98=9.8折</span>
                        </div>
                        </td>
                    </tr>   <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6">
                        <div align="right">
                            <span class="STYLE19">积分下限：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                        <input type="text" name="jifen_bottom" id="point_bottom" />
                        <span style="color: red">不能小于0</span>
                    </div>
                    </td>
                </tr>   <tr>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE6">
                        <div align="right">
                            <span class="STYLE19">积分上限：</span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                        <input type="text" name="jifen_top" id="point_top" />
                    </div>
                    </td>
                </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
    <tr>
        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
            <input type="button" value="添加" class="level" />
        </td>
    </tr>
</table>
</form>
</td>
</tr>
</table>
</body>
<script type="text/javascript">
    $('.level').click(function(){
        var data = {
            level_name:$('#level_name').val(),
            level_rate:$('#level_rate').val(),
            point_bottom:$('#point_bottom').val(),
            point_top:$('#point_top').val()
        }
        //console.log(data);
        $.ajax({
            url:"<?php echo U('addMemberLevel');?>",
            data:{'data':data},
            dataType:'json',
            type:'post',
            success:function(msg){
                //console.log(msg.status);
                if(msg.status==200){
                    layer.msg(msg.message);
                    setTimeout( 'window.location.href="<?php echo U('memberLevelList');?>"',2000);
                }else if(msg.status==202){
                    layer.msg(msg.message);
                    setTimeout( 'window.location.href="<?php echo U('memberLevelList');?>"',2000);
                }
            }
        });
    })
</script>
</html>