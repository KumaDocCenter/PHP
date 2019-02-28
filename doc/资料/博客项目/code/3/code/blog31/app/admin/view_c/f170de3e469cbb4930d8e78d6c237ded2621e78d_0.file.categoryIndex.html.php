<?php
/* Smarty version 3.1.29, created on 2018-07-13 15:12:20
  from "F:\home\class\day15\code\blog31\app\admin\view\Category\categoryIndex.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5b4850d4a20968_99027695',
  'file_dependency' => 
  array (
    'f170de3e469cbb4930d8e78d6c237ded2621e78d' => 
    array (
      0 => 'F:\\home\\class\\day15\\code\\blog31\\app\\admin\\view\\Category\\categoryIndex.html',
      1 => 1531465858,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b4850d4a20968_99027695 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>博客后台</title>
    <link rel="stylesheet" type="text/css" href="<?php echo C('URL');?>
/public/admin/css/app.css" />
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo C('URL');?>
/public/admin/js/app.js"><?php echo '</script'; ?>
>
</head>
<body>
<div class="wrapper">

    <!-- START HEADER -->
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
    </div>
    <!-- END HEADER -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START SIDEBAR -->
        <div id="sidebar">
            <div id="searchbox" style="z-index: 880;">
                <div class="in" style="z-index: 870;">
                    <p class="text-center font18 line-height35">此广告位常年招商</p>
                </div>
            </div>
            <!-- start sidemenu -->
            <div id="sidemenu">
            	<ul>
                	<li class="active"><a href="index.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/laptop.png" width="16" height="16" alt="icon"/>控制面板</a></li>
                    <!-- 分类管理 -->
                    <li class="subtitle">
                        <a class="action tips-right" href="#" title="分类管理">
							<img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/key.png" width="16" height="16" alt="icon"/>分类管理<img src="<?php echo C('URL');?>
/public/admin/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" />
						</a>
                        <ul class="submenu display-block">
                            <li><a href="../category/categoryIndex.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>分类列表</a></li>
                            <li><a href="../category/categoryAdd.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/file_add.png" width="16" height="16" alt="icon"/>添加分类</a></li>
                        </ul>
                    </li>
                    <!-- 分类管理 -->

                    <!-- 博文管理 -->
                    <li class="subtitle">
                    	<a class="action tips-right" href="#" title="博文管理">
							<img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/mail.png" width="16" height="16" alt="icon"/>博文管理<img src="<?php echo C('URL');?>
/public/admin/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" />
						</a>
                    	<ul class="submenu display-block">
							<li>
								<a href="../article/articleAdd.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/file_add.png" width="16" height="16" alt="icon"/>添加博文</a>
							</li>
							<li>
								<a href="../article/articleIndex.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>博文列表</a>
							</li>
                        </ul>
                    </li>
                    <!-- 博文管理 -->

                    <!-- 用户管理 -->
                    <li class="subtitle">
                        <a class="action tips-right" href="#" title="用户管理"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/user.png" width="16" height="16" alt="icon"/>用户管理<img src="<?php echo C('URL');?>
/public/admin/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" /></a>
                        <ul class="submenu display-block">
                            <li>
								<a href="../user/userAdd.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/user_add.png" width="16" height="16" alt="icon"/>添加用户</a>
							</li>
                            <li>
								<a href="../user/userIndex.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>用户列表</a>
							</li>
                        </ul>
                    </li>
                    <!-- 用户管理 -->

                    <!-- 评论管理 -->
                    <li>
						<a href="../comment/commentIndex.html"><img src="<?php echo C('URL');?>
/public/admin/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>评论列表</a>
					</li>
                    <!-- 评论管理 -->
                </ul>
            </div>
            <!-- end sidemenu -->
        </div>
        <!-- END SIDEBAR -->

        <!-- START PAGE -->
        <div id="page">
            <!-- start page title -->
            <div class="page-title">
                <div class="in">
                    <div class="titlebar">	<h2>分类管理</h2>	<p>分类列表</p></div>

                    <div class="clear"></div>
                </div>
            </div>
            <!-- end page title -->

            <!-- START CONTENT -->
            <div class="content">
                <!-- START TABLE -->
                <div class="simplebox grid740">

                    <div class="titleh">
                        <h3>分类列表</h3>
                    </div>

                    <table id="myTable" class="tablesorter">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
$_from = $_smarty_tpl->tpl_vars['cats']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_cat_0_saved_item = isset($_smarty_tpl->tpl_vars['cat']) ? $_smarty_tpl->tpl_vars['cat'] : false;
$_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['cat']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
$__foreach_cat_0_saved_local_item = $_smarty_tpl->tpl_vars['cat'];
?>
							<tr>
								<td><?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
</td>
								<td><?php echo str_repeat('--- --- ',$_smarty_tpl->tpl_vars['cat']->value['space']);
echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</td>
								<td>
									<a href="<?php echo C('URL');?>
/index.php?p=admin&m=cat&a=showUpd&id=<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：<?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
?');">删除</a>
								</td>
							</tr>
						<?php
$_smarty_tpl->tpl_vars['cat'] = $__foreach_cat_0_saved_local_item;
}
if ($__foreach_cat_0_saved_item) {
$_smarty_tpl->tpl_vars['cat'] = $__foreach_cat_0_saved_item;
}
?>
							<!-- <tr>
								<td>2</td>
								<td>----计算机</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：计算机?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>--------笔记本</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：笔记本?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>----航空航天</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：航空航天?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>--------民航</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：民航?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>--------火星计划</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：火星计划?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td>美食</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：美食?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td>----湘菜</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：湘菜?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td>--------口味虾</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：口味虾?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>10</td>
								<td>--------口味蛇</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：口味蛇?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>11</td>
								<td>--------口味蛙</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：口味蛙?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>12</td>
								<td>--------宫保鸡丁</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：宫保鸡丁?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>13</td>
								<td>--------黄鸭叫</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：黄鸭叫?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>14</td>
								<td>----川菜</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：川菜?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>15</td>
								<td>----粤菜</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：粤菜?');">删除</a>
								</td>
							</tr>
							<tr>
								<td>16</td>
								<td>----徽菜</td>
								<td>100</td>
								<td>
									<a href="#">编辑</a>
									<a href="#" onClick="return confirm('确定删除当前分类：徽菜?');">删除</a>
								</td>
							</tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- END TABLE -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END PAGE -->
        <div class="clear"></div>
    </div>
    <!-- END MAIN -->

    <!-- START FOOTER -->
    <div id="footer">
    	<div class="left-column">© Copyright 2016 - 保留所有权利.</div>
    </div>
    <!-- END FOOTER -->
</div>
</body>
</html><?php }
}
