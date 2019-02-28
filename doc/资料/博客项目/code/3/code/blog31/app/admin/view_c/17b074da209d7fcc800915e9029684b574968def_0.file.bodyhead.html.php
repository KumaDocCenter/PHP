<?php
/* Smarty version 3.1.29, created on 2018-07-14 16:36:32
  from "F:\home\class\day16\code\blog31\app\admin\view\Common\bodyhead.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5b49b61047ba87_82783006',
  'file_dependency' => 
  array (
    '17b074da209d7fcc800915e9029684b574968def' => 
    array (
      0 => 'F:\\home\\class\\day16\\code\\blog31\\app\\admin\\view\\Common\\bodyhead.html',
      1 => 1531556721,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b49b61047ba87_82783006 ($_smarty_tpl) {
?>
<div id="header">
	<!-- logo -->
	<div class="logo">	<a href="#"><span class="logo-text text-center font18">博客后台</span></a>	</div>

	<!-- notifications -->
	<div id="notifications">
	  <div class="clear"></div>
	</div>

	<!-- quick menu -->
	<div id="quickmenu">
		<a href="" class="qbutton-left tips" title="新增一篇博客">
			<img src="<?php echo C('URL');?>
/public/admin/img/icons/header/newpost.png" width="18" height="14" alt="new post" />
		</a>
		<a href="#" target="__blank" class="qbutton-right tips" title="直达前台">
			<img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/magnify.png" width="18" height="14" alt="new post" />
		</a>
		<div class="clear"></div>
	</div>

	<!-- profile box -->
	<div id="profilebox">
		<a href="#" class="display">
			<img src="<?php echo C('URL');?>
/public/admin/img/simple-profile-img.jpg" width="33" height="33" alt="profile"/> <span>管理员</span> <b>昵称：xiaozhangsan</b>
		</a>

		<div class="profilemenu">
			<ul>
				<li><a href="#">退出</a></li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div><?php }
}
