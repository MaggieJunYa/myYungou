<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加商品类型</title>
    <script type="text/javascript" src="<?php echo C('AD_JS');?>jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="<?php echo C('AD_JS');?>layer.js"></script>
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
    </style>
</head>

<body>
<style type="text/css">
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
<script type="text/javascript">
</script>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 商品管理 -> 修改类型</span></td>
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
                                <span class="STYLE19">类型名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="hidden"  name='type_id' value="<?php echo ($type["type_id"]); ?>">
                            <input type="text" name="type_name" id="type_name" value="<?php echo ($type["type_name"]); ?>"/>
                        </div></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
                            <input type="button" value="修改类型" class="type" />
                        </td>
                    </tr>
                </table>
</form>
</td>
</tr>
</table>
<script type="text/javascript">
    //修改商品
    $('.type').click(function(){
        var type_id = $('[name=type_id]').val();
        alert(type_id);
        var type_name = $('[name=type_name]').val();
        var data = {
            type_id:type_id,
            type_name:type_name
        }
        $.ajax({
            url:"<?php echo U('updType');?>",
            data:{'data':data},
            dataType:'json',
            type:'post',
            success:function (msg) {
                if(msg.status == 200){
                    layer.msg(msg.message);
                    setTimeout( 'window.location.href="<?php echo U('showlist');?>"',2000);
                }else if(msg.status == 202){
                    layer.msg(msg.message);
                    setTimeout( 'window.location.href="<?php echo U('showlist');?>"',2000);
                }
            }
        })
    });
</script>
</body>
</html>