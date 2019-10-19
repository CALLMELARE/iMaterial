<?php

/**
 * My Material 主题
 *
 * @package iMaterial
 * @author CALLMELARE
 * @version 0.9
 * @link https://github.com/CALLMELARE/iMaterial
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

if (!$this->request->isAjax()) {
    $this->need('header.php');
} else if ($this->request->isAjax() && $this->request->get('page') <= 1) {
    $this->need('siteTitle.php');
}

if ($this->request->isAjax() && $this->request->get('page') > 1) {
    //ajax load more
    $this->need('postCard.php');
} else {
    $this->need('home.php');
}

if (!$this->request->isAjax()) {
    $this->need('links.php');
}

if (!$this->request->isAjax()) {
    $this->need('footer.php');
}
