<?php
/* Smarty version 3.1.29, created on 2018-07-16 16:19:48
  from "F:\home\class\day17\code\blog31\app\home\view\blogShow.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5b4c5524ad1881_16517107',
  'file_dependency' => 
  array (
    '92f36fc9ad018d772fbcd80d0a22186534ec7031' => 
    array (
      0 => 'F:\\home\\class\\day17\\code\\blog31\\app\\home\\view\\blogShow.html',
      1 => 1531729180,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b4c5524ad1881_16517107 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>博文内容</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link href="<?php echo C('URL');?>
/public/home/css/app.css" rel="stylesheet" media="screen">
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/modernizr.custom.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/detectizr.min.js"><?php echo '</script'; ?>
>
</head>

<!-- Body -->
<body>
<!-- Page Wrapper -->
<div class="page-wrapper">
  <!-- Navbar -->
  <!-- Add class ".navbar-sticky" to make navbar stuck when it hits the top of the page. Another modifier class is: "navbar-fullwidth" to stretch navbar and make it occupy 100% of the page width. The screen width at which navbar collapses can be controlled through the variable "$nav-collapse" in sass/variables.scss -->
  <header class="navbar">

    <!-- Toolbar -->
    <div class="topbar">
      <div class="container">
        <a href="" class="site-logo">
          博文前台
        </a><!-- .site-logo -->
      </div><!-- .container -->
    </div><!-- .topbar -->
  </header><!-- .navbar -->

  <!-- Page Title -->
  <!--Add modifier class : "pt-fullwidth" to stretch page title and make it occupy 100% of the page width. -->
  <section class="page-title">
    <div class="container">
      <div class="inner">
        <div class="column">
          <div class="title">
            <h1>博文内容</h1>
          </div><!-- .title -->
        </div><!-- .column -->
        <div class="column">
        </div><!-- .column -->
      </div>
    </div>
  </section><!-- .page-title -->

  <!-- Container -->
    <div class="container">

      <!-- Content -->
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <h1><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</h1>
          <div class="post-meta">
            <div class="column">
              <span>
                <i class="icon-head"></i>
                <a href="#"><?php echo $_smarty_tpl->tpl_vars['article']->value['user_nickname'];?>
</a>
              </span>
              <span>在</span>
              <span>
                <i class="icon-ribbon"></i>
                <a href="#"><?php echo $_smarty_tpl->tpl_vars['article']->value['cat_name'];?>
</a>
              </span>
              <span>下发布</span>
              <span class="post-comments">
                <i class="icon-speech-bubble"></i>
                <a href="#"><?php echo $_smarty_tpl->tpl_vars['article']->value['comment_num'];?>
</a>
              </span>
            </div>
            <div class="column"><span><?php echo date('Y m d H:i',$_smarty_tpl->tpl_vars['article']->value['post_date']);?>
</span></div>
          </div><!-- .post-meta -->
          <?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['article']->value['content']);?>

          <div class="post-tools space-top-2x">
            <div class="column">
              <div class="tags-links">
                <a href="#">美食</a>
                <a href="#">教程</a>
                <a href="#">厨艺</a>
              </div>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .post-tools -->
          <div class="post-tools space-top-2x">
            <div class="column"></div>
            <div class="column text-center">
              <a href=""><i class="fa fa-thumbs-up dz" aria-hidden="true">[4]</i></a>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .post-tools -->

          <!-- Comments -->
          <div class="comments-area space-top-3x">
            <h4 class="comments-count">共有<?php echo count($_smarty_tpl->tpl_vars['comments']->value);?>
条评论</h4>

            <!-- Comment -->
			<?php
$_from = $_smarty_tpl->tpl_vars['comments']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_comment_0_saved_item = isset($_smarty_tpl->tpl_vars['comment']) ? $_smarty_tpl->tpl_vars['comment'] : false;
$_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['comment']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value) {
$_smarty_tpl->tpl_vars['comment']->_loop = true;
$__foreach_comment_0_saved_local_item = $_smarty_tpl->tpl_vars['comment'];
?>
            <div class="comment">
              <div class="comment-meta">
                <div class="column">
                  <span class="comment-autor"><i class="icon-head"></i><a href="#"><?php echo $_smarty_tpl->tpl_vars['comment']->value['user_nickname'];?>
</a></span>
                </div>
                <div class="column">
                  <span class="comment-date"><?php echo date('Y.m.d H:i:s',$_smarty_tpl->tpl_vars['comment']->value['post_date']);?>
</span>
                </div>
              </div><!-- .comment-meta -->
              <div class="comment-body">
                <p><?php echo $_smarty_tpl->tpl_vars['comment']->value['content'];?>
</p>
              </div><!-- .comment-body -->
            </div><!-- .comment -->
			<?php
$_smarty_tpl->tpl_vars['comment'] = $__foreach_comment_0_saved_local_item;
}
if ($__foreach_comment_0_saved_item) {
$_smarty_tpl->tpl_vars['comment'] = $__foreach_comment_0_saved_item;
}
?>
            
            <!-- Comment Form -->
            <div class="comment-respond">
              <h4 class="comment-reply-title">发布新评论</h4>
              <form method="post" id="comment-form" class="comment-form" action="<?php echo C('URL');?>
/index.php?p=home&m=index&a=talk">
			  <input type="hidden" name="article_id" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" />
			  <input type="hidden" name="article_title" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
" />
                <div class="form-group">
                  <label for="cf_comment" class="sr-only">Comment</label>
                  <textarea name="comment" id="cf_comment" class="form-control input-alt" rows="7" placeholder="输入您的评论"></textarea>
                </div>            
                <p class="form-submit">
				<!-- 如果用户登录后才允许发表 -->
				<?php if (isset($_SESSION['home'])) {?>
                  <input name="submit" type="submit" id="submit" class="btn btn-primary btn-block" value="发布">
				<?php } else { ?>
				  您尚未登录！
				<?php }?>
                </p>
              </form>
            </div><!-- .comment-respond -->
          </div><!-- .comments-area -->
        </div><!-- .col-lg-9.col-md-8 -->
      </div><!-- .row -->
    </div><!-- .container -->

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->

    <!-- Footer -->
    <!-- Footer -->
    <footer class="footer">
      <div class="bottom-footer">
        <div class="container">
          <div class="copyright">
            <div class="column">
              <p>&copy; 2016. 保留所有权利。</p>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .copyright -->
        </div><!-- .container -->
      </div><!-- .bottom-footer -->
    </footer><!-- .footer -->

  </div><!-- .page-wrapper -->

  <!-- JavaScript (jQuery) libraries, plugins and custom scripts -->
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/jquery-2.1.4.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/bootstrap.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/waves.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/placeholder.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/waypoints.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/vendor/velocity.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo C('URL');?>
/public/home/js/scripts.js"><?php echo '</script'; ?>
>
</body><!-- <body> -->
</html>
<?php }
}
