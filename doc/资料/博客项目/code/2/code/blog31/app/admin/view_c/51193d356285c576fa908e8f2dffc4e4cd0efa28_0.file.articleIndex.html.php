<?php
/* Smarty version 3.1.29, created on 2018-07-13 17:22:51
  from "F:\home\class\day15\code\blog31\app\admin\view\Article\articleIndex.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5b486f6b6c14e5_78557625',
  'file_dependency' => 
  array (
    '51193d356285c576fa908e8f2dffc4e4cd0efa28' => 
    array (
      0 => 'F:\\home\\class\\day15\\code\\blog31\\app\\admin\\view\\Article\\articleIndex.html',
      1 => 1531473768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b486f6b6c14e5_78557625 ($_smarty_tpl) {
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
                    <div class="titlebar">	<h2>博文管理</h2>	<p>博文列表</p></div>

                    <div class="clear"></div>
                </div>
            </div>
            <!-- end page title -->

            <!-- START CONTENT -->
            <div class="content">
                <div class="simplebox grid740" style="z-index: 720;">
                    <div class="titleh" style="z-index: 710;">
                        <h3>搜索</h3>
                    </div>
                    <div class="body" style="z-index: 690;">

                        <form id="form2" name="form2" method="post" action="">
							<input type="hidden" name="p" value="back"/>
							<input type="hidden" name="m" value="article"/>
                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">标题</span>
                                <input name="a_name" type="text" class="st-forminput" style="width:510px" value="">
                                <div class="clear" style="z-index: 670;"></div>
                            </div>
                            <div class="st-form-line" style="z-index: 640;">
                                <span class="st-labeltext">分类</span>
                                <select class="uniform" name="c_id">
									<option value="0">任意</option>
                                    <option value="1">科技1</option>
                                    <option value="5">----IT</option>
                                    <option value="6">----生物</option>
                                    <option value="7">--------鸟类</option>
                                    <option value="2">武侠</option>
                                    <option value="3">旅游</option>
                                    <option value="4">美食</option>
                                    <option value="8">----湘菜</option>
                                    <option value="11">--------跳跳蛙</option>
                                    <option value="12">--------口味虾</option>
                                    <option value="13">--------臭豆腐</option>
                                    <option value="9">----粤菜</option>
                                    <option value="14">--------白切鸡</option>
                                    <option value="15">--------隆江猪脚</option>
                                    <option value="10">----川菜</option>
                                </select>
                                <div class="clear"></div>
                            </div>
                            <div class="st-form-line">
                                <span class="st-labeltext">状态</span>
                                <select class="uniform" name="a_status">
                                    <option value="">任意</option>
                                    <option value="1">草稿</option>
                                    <option value="2">公开</option>
                                    <option value="3">隐藏</option>
                                </select>
                                <div class="clear"></div>
                            </div>
                            <div class="button-box" style="z-index: 460;">
                                <input type="submit" name="button" id="button" value="提交" class="st-button">
                            </div>
                        </form>

                    </div>
                </div>

                <!-- START TABLE -->
                <div class="simplebox grid740">

                    <div class="titleh">
                        <h3>博文列表</h3>
                    </div>

                    <table id="myTable" class="tablesorter">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>#ID</th>
                            <th>分类名</th>
                            <th>标题</th>
                            <th>发布日期</th>
                            <th>评论数量</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
$_from = $_smarty_tpl->tpl_vars['articles']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_article_0_saved_item = isset($_smarty_tpl->tpl_vars['article']) ? $_smarty_tpl->tpl_vars['article'] : false;
$_smarty_tpl->tpl_vars['article'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['article']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
$__foreach_article_0_saved_local_item = $_smarty_tpl->tpl_vars['article'];
?>
						<tr>
                            <td>1</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['article']->value['cat_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</td>
                            <td><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['article']->value['post_date']);?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['article']->value['comment_num'];?>
</td>
                            <td>
								 <a href="#" >编辑</a>
                                <a href="#" onClick="return confirm('是否确认删除文章：口味蛙？');">删除</a>
                            </td>
                        </tr>
						<?php
$_smarty_tpl->tpl_vars['article'] = $__foreach_article_0_saved_local_item;
}
if ($__foreach_article_0_saved_item) {
$_smarty_tpl->tpl_vars['article'] = $__foreach_article_0_saved_item;
}
?>
						                        <!-- <tr> -->
                            <!-- <td>2</td> -->
                            <!-- <td>口味蛙</td> -->
                            <!-- <td>剁椒鱼头</td> -->
                            <!-- <td>2017-03-27</td> -->
                            <!-- <td>12</td> -->
                            <!-- <td>100</td> -->
                            <!-- <td> -->
								 <!-- <a href="#" >编辑</a> -->
                                <!-- <a href="#" onClick="return confirm('是否确认删除文章：口味蛙？');">删除</a> -->
                            <!-- </td> -->
                        <!-- </tr> -->
						                        <!-- <tr> -->
                            <!-- <td>3</td> -->
                            <!-- <td>口味蛙</td> -->
                            <!-- <td>萝卜炖牛腩</td> -->
                            <!-- <td>2017-03-27</td> -->
                            <!-- <td>12</td> -->
                            <!-- <td>100</td> -->
                            <!-- <td> -->
								 <!-- <a href="#" >编辑</a> -->
                                <!-- <a href="#" onClick="return confirm('是否确认删除文章：口味蛙？');">删除</a> -->
                            <!-- </td> -->
                        <!-- </tr> -->
                        </tbody>
                    </table>
                    <ul class="pagination">
                         <li><a href='#'>1</a></li>
						 <li><a href='#'>2</a></li>
						 <li><a href='#'>3</a></li>
						 <li><a href='#'>4</a></li>
						 <li><a href='#'>下一页</a></li>
                    </ul>
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
