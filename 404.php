<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!$this->request->isAjax()) {
    $this->need('header.php');
} else {
    $this->need('siteTitle.php');
} ?>

<div class="post-card mdl-card mdl-cell mdl-shadow--2dp mdl-cell--12-col hover-shadow--4dp menu-dialog-visible">
    <div style="width: 100%;text-align: center;padding: 80px 16px;box-sizing: border-box">
        <h2 style="font-size: 128px;line-height: 100px;">404</h2>
        <div style="padding-top: 16px; word-break: break-all;overflow: hidden;box-sizing: border-box;line-height: 22px;">
            我的心丟了，你能找到它吗
        </div>
        <a style="margin-top: 20px;" href="<?php $this->options->siteUrl(); ?>"
           class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">首页</a>
    </div>
</div>
<?php if (!$this->request->isAjax()) {
    $this->need('footer.php');
} ?>
