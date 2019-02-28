<?php
/* Smarty version 3.1.29, created on 2018-07-14 19:40:36
  from "F:\home\class\day16\code\blog31\app\admin\view\Privilege\login.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5b49e134f3e589_80556558',
  'file_dependency' => 
  array (
    '968bda88e87431ee2c28bf84412b1ce1b17fc62e' => 
    array (
      0 => 'F:\\home\\class\\day16\\code\\blog31\\app\\admin\\view\\Privilege\\login.html',
      1 => 1531567764,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:Common/head.html' => 1,
  ),
),false)) {
function content_5b49e134f3e589_80556558 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
    <div class="loginform">
    	<div class="title"> <span class="logo-text font18">博客后台管理系统</span></div>
        <div class="body">
       	  <form id="form1" name="form1" method="post" action="<?php echo C('URL');?>
/index.php?p=admin&m=login&a=loginh">
          	<label class="log-lab">帐号</label>
            <input name="acc" type="text" class="login-input-user" id="textfield" value=""/>
          	<label class="log-lab">密码</label>
            <input name="pwd" type="password" class="login-input-pass" id="textfield" value=""/>
			<label class="log-lab">验证码</label>
			<div class="padding-bottom5"><img id='img' src="<?php echo C('URL');?>
/index.php?p=admin&m=login&a=captcha" width="220" height="80"></div>
			<input name="captcha" type="text" class="login-input" id="textfield" value=""/>
			<label class="log-lab"><input type="checkbox" name="rememberMe" class="uniform"> 7天内自动登录</label>
            <input type="submit" name="button" id="button" value="登录" class="button"/>
<?php echo '<script'; ?>
 type="text/javascript">
document.getElementById('img').onclick = function (){

	this.src = "<?php echo C('URL');?>
/index.php?p=admin&m=login&a=captcha&randnum="+Math.random();
}
<?php echo '</script'; ?>
>

       	  </form>
        </div>
    </div>
</div>
</body>
</html>
<?php }
}
