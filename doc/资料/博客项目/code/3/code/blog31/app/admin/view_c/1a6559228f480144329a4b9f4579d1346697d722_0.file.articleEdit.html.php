<?php
/* Smarty version 3.1.29, created on 2018-07-14 16:36:32
  from "F:\home\class\day16\code\blog31\app\admin\view\Article\articleEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5b49b610458800_87085794',
  'file_dependency' => 
  array (
    '1a6559228f480144329a4b9f4579d1346697d722' => 
    array (
      0 => 'F:\\home\\class\\day16\\code\\blog31\\app\\admin\\view\\Article\\articleEdit.html',
      1 => 1531557365,
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
function content_5b49b610458800_87085794 ($_smarty_tpl) {
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
                    <div class="titlebar">	<h2>博文管理</h2>	<p>编辑博文</p></div>

                    <div class="clear"></div>
                </div>
            </div>
            <!-- end page title -->

            <!-- START CONTENT -->
            <div class="content">
                <div class="simplebox grid740" style="z-index: 720;">
                    <div class="titleh" style="z-index: 710;">
                        <h3>编辑博文</h3>
                    </div>
                    <div class="body" style="z-index: 690;">

                        <form id="form2" name="form2" method="post" action="<?php echo C('URL');?>
/index.php?p=admin&m=article&a=updh&id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
">
                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">标题</span>
                                <input name="title" type="text" class="st-forminput" style="width:510px" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
">
                                <div class="clear" style="z-index: 670;"></div>
                            </div>
                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">简介</span>
                                <textarea name="intro" rows=7 cols=90><?php echo $_smarty_tpl->tpl_vars['article']->value['intro'];?>
</textarea>
                                <div class="clear" style="z-index: 670;"></div>
                            </div>
                            <div class="st-form-line" style="z-index: 640;">
                                <span class="st-labeltext">分类</span>
                                <select class="uniform" name="cat">
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
									<option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
|<?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
"<?php if ($_smarty_tpl->tpl_vars['article']->value['cat_id'] == $_smarty_tpl->tpl_vars['cat']->value['id']) {?> selected<?php }?>><?php echo str_repeat('--- --- ',$_smarty_tpl->tpl_vars['cat']->value['space']);
echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</option>
								<?php
$_smarty_tpl->tpl_vars['cat'] = $__foreach_cat_0_saved_local_item;
}
if ($__foreach_cat_0_saved_item) {
$_smarty_tpl->tpl_vars['cat'] = $__foreach_cat_0_saved_item;
}
?>
									<!-- <option value="2" >--计算机</option> -->
									<!-- <option value="17" >----笔记本</option> -->
									<!-- <option value="11" >--徽菜</option> -->
                                </select>
                                <div class="clear"></div>
                            </div>
                            <!-- START jWYSIWYG TEXT EDITOR -->
                            <div class="simplebox grid740">
                                <div class="titleh">
                                    <h3>内容</h3>
                                </div>
                                <div class="body">
                                    <textarea class="st-forminput" rows="5" cols="47" style="width:96.5%;" name="content"><?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>
</textarea>
									<?php echo '<script'; ?>
>CKEDITOR.replace('content');<?php echo '</script'; ?>
>
                                </div>

                            </div>
                            <!-- END jWYSIWYG TEXT EDITOR -->

                            <div class="button-box" style="z-index: 460;">
                                <input type="submit" name="button" id="button" value="提交" class="st-button">
                            </div>
                        </form>

                    </div>
                </div>
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
