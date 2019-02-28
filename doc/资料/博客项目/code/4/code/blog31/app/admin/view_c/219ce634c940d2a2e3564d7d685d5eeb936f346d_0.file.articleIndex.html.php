<?php
/* Smarty version 3.1.29, created on 2018-07-14 16:38:09
  from "F:\home\class\day16\code\blog31\app\admin\view\Article\articleIndex.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5b49b6714d1987_14254538',
  'file_dependency' => 
  array (
    '219ce634c940d2a2e3564d7d685d5eeb936f346d' => 
    array (
      0 => 'F:\\home\\class\\day16\\code\\blog31\\app\\admin\\view\\Article\\articleIndex.html',
      1 => 1531557343,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:Common/head.html' => 1,
    'file:Common/bodyhead.html' => 1,
    'file:Common/sidebar.html' => 1,
  ),
),false)) {
function content_5b49b6714d1987_14254538 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<div class="wrapper">
    <!-- START HEADER -->
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:Common/bodyhead.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <!-- END HEADER -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START SIDEBAR -->
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:Common/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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

                        <form id="form2" name="form2" method="post" action="<?php echo C('URL');?>
/index.php?p=admin&m=article&a=showList">
                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">标题</span>
                                <input name="s_title" type="text" class="st-forminput" style="width:510px" value="<?php echo $_smarty_tpl->tpl_vars['s_title']->value;?>
">
                                <div class="clear" style="z-index: 670;"></div>
                            </div>
                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">发表者</span>
                                <select class="uniform" name="s_user_id">
									<option value="0">请选择发表者...</option>
								<?php
$_from = $_smarty_tpl->tpl_vars['users']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_user_0_saved_item = isset($_smarty_tpl->tpl_vars['user']) ? $_smarty_tpl->tpl_vars['user'] : false;
$_smarty_tpl->tpl_vars['user'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['user']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
$__foreach_user_0_saved_local_item = $_smarty_tpl->tpl_vars['user'];
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['s_user_id']->value == $_smarty_tpl->tpl_vars['user']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['user']->value['nickname'];?>
</option>
								<?php
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_0_saved_local_item;
}
if ($__foreach_user_0_saved_item) {
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_0_saved_item;
}
?>
                                    <!-- <option value="15">lisi</option> -->
                                    <!-- <option value="10">wangwu</option> -->
                                </select>
                                <div class="clear" style="z-index: 670;"></div>
                            </div>
                            <div class="st-form-line" style="z-index: 640;">
                                <span class="st-labeltext">分类</span>
                                <select class="uniform" name="s_cat_id">
									<option value="0">任意</option>
									<?php
$_from = $_smarty_tpl->tpl_vars['cats']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_cat_1_saved_item = isset($_smarty_tpl->tpl_vars['cat']) ? $_smarty_tpl->tpl_vars['cat'] : false;
$_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['cat']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
$__foreach_cat_1_saved_local_item = $_smarty_tpl->tpl_vars['cat'];
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['s_cat_id']->value == $_smarty_tpl->tpl_vars['cat']->value['id']) {?> selected<?php }?>><?php echo str_repeat('--- --- ',$_smarty_tpl->tpl_vars['cat']->value['space']);
echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</option>
									<?php
$_smarty_tpl->tpl_vars['cat'] = $__foreach_cat_1_saved_local_item;
}
if ($__foreach_cat_1_saved_item) {
$_smarty_tpl->tpl_vars['cat'] = $__foreach_cat_1_saved_item;
}
?>
                                    <!-- <option value="5">----IT</option> -->
                                    <!-- <option value="6">----生物</option> -->
                                    <!-- <option value="7">--------鸟类</option> -->
                                    <!-- <option value="2">武侠</option> -->
                                    <!-- <option value="3">旅游</option> -->
                                    <!-- <option value="4">美食</option> -->
                                    <!-- <option value="8">----湘菜</option> -->
                                    <!-- <option value="11">--------跳跳蛙</option> -->
                                    <!-- <option value="12">--------口味虾</option> -->
                                    <!-- <option value="13">--------臭豆腐</option> -->
                                    <!-- <option value="9">----粤菜</option> -->
                                    <!-- <option value="14">--------白切鸡</option> -->
                                    <!-- <option value="15">--------隆江猪脚</option> -->
                                    <!-- <option value="10">----川菜</option> -->
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
$__foreach_article_2_saved_item = isset($_smarty_tpl->tpl_vars['article']) ? $_smarty_tpl->tpl_vars['article'] : false;
$__foreach_article_2_saved_key = isset($_smarty_tpl->tpl_vars['article_key']) ? $_smarty_tpl->tpl_vars['article_key'] : false;
$_smarty_tpl->tpl_vars['article'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['article_key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['article']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['article_key']->value => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
$__foreach_article_2_saved_local_item = $_smarty_tpl->tpl_vars['article'];
?>
						<tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['firstNum']->value+$_smarty_tpl->tpl_vars['article_key']->value;?>
</td>
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
								 <a href="<?php echo C('URL');?>
/index.php?p=admin&m=article&a=showUpd&id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" >编辑</a>
                                <a href="#" onClick="return confirm('是否确认删除文章：口味蛙？');">删除</a>
                            </td>
                        </tr>
						<?php
$_smarty_tpl->tpl_vars['article'] = $__foreach_article_2_saved_local_item;
}
if ($__foreach_article_2_saved_item) {
$_smarty_tpl->tpl_vars['article'] = $__foreach_article_2_saved_item;
}
if ($__foreach_article_2_saved_key) {
$_smarty_tpl->tpl_vars['article_key'] = $__foreach_article_2_saved_key;
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
						<?php echo $_smarty_tpl->tpl_vars['pageHtml']->value;?>

                         <!-- <li><a href='#'>1</a></li> -->
						 <!-- <li><a href='#'>2</a></li> -->
						 <!-- <li><a href='#'>3</a></li> -->
						 <!-- <li><a href='#'>4</a></li> -->
						 <!-- <li><a href='#'>下一页</a></li> -->
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
