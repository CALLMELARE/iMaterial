<!-- 这里的内容显示在“控制台-外观-设置外观” -->

<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $homeCard = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'homeCard',
        array(
            'showLeft' => _t('显示首页左侧卡片'),
            'showRight' => _t('显示首页右侧卡片'),
            'showBreadcrumb' => _t('显示导航条'),
            'showAllList' => _t('显示所有文章侧拉栏')
        ),
        array('showLeft', 'showRight', 'showBreadcrumb', 'showAllList'),
        _t('首页功能')
    );
    $form->addInput($homeCard->multiMode());

    $LeftImage = new Typecho_Widget_Helper_Form_Element_Text(
        'leftImageUrl',
        NULL,
        NULL,
        _t('站点 左侧卡片背景图'),
        _t('在这里填入一个图片 URL 地址')
    );
    $form->addInput($LeftImage);
    $rightImage = new Typecho_Widget_Helper_Form_Element_Text(
        'rightImageUrl',
        NULL,
        NULL,
        _t('站点 右侧卡片背景图'),
        _t('在这里填入一个图片 URL 地址')
    );
    $form->addInput($rightImage);

    $drawerImage = new Typecho_Widget_Helper_Form_Element_Text(
        'drawerImageUrl',
        NULL,
        NULL,
        _t('站点 导航栏的背景图'),
        _t('在这里填入一个图片 URL 地址')
    );
    $form->addInput($drawerImage);

    $drawerBlock = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'drawerBlock',
        array(
            'ShowPages' => _t('显示页面'),
            'ShowCategory' => _t('显示分类'),
            'ShowArchive' => _t('显示归档')
        ),
        array('ShowPages', 'ShowCategory', 'ShowArchive'),
        _t('抽屉显示')
    );
    $form->addInput($drawerBlock->multiMode());

    $siteTime = new Typecho_Widget_Helper_Form_Element_Text(
        'siteTime',
        NULL,
        '2019-01-01',
        _t('网站开始时间'),
        _t('填入日期, 例如 (2019-01-01 00:00:00)')
    );
    $form->addInput($siteTime);

    $customFooter = new Typecho_Widget_Helper_Form_Element_Text(
        'customFooter',
        NULL,
        NULL,
        _t('页脚自定义文字'),
        _t('填入一些东西(备案之类的信息..), 也可写入html..\(^o^)/')
    );
    $form->addInput($customFooter);

    $ftGithub = new Typecho_Widget_Helper_Form_Element_Text(
        'ftGithub',
        NULL,
        NULL,
        _t('页脚联系方式: GitHub'),
        _t('填入github登录用户名')
    );
    $form->addInput($ftGithub);

    $ftQQ = new Typecho_Widget_Helper_Form_Element_Text(
        'ftQQ',
        NULL,
        NULL,
        _t('页脚联系方式: QQ'),
        _t('填入QQ号码')
    );
    $form->addInput($ftQQ);

    $ftWeibo = new Typecho_Widget_Helper_Form_Element_Text(
        'ftWeibo',
        NULL,
        NULL,
        _t('页脚联系方式: Weibo'),
        _t('填入微博主页网址Url')
    );
    $form->addInput($ftWeibo);

    $ftEmail = new Typecho_Widget_Helper_Form_Element_Text(
        'ftEmail',
        NULL,
        NULL,
        _t('页脚联系方式: Email'),
        _t('填入邮箱')
    );
    $form->addInput($ftEmail);

    $ftCodePen = new Typecho_Widget_Helper_Form_Element_Text(
        'ftCodePen',
        NULL,
        NULL,
        _t('页脚联系方式:CodePen'),
        _t('填入CodePen用户名')
    );
    $form->addInput($ftCodePen);

    $ftLeetCode = new Typecho_Widget_Helper_Form_Element_Text(
        'ftLeetCode',
        NULL,
        NULL,
        _t('页脚联系方式:LeetCode'),
        _t('填入LeetCode用户名')
    );
    $form->addInput($ftLeetCode);

    // $ftVisitor = new Typecho_Widget_Helper_Form_Element_Text(
    //     'ftVisitor',
    //     NULL,
    //     NULL,
    //     _t('地球访客'),
    //     _t('填写https://www.revolvermaps.com/得到的代码的**src部分** (不填则不用该功能)')
    // );
    // $form->addInput($ftVisitor);

    // $doubanId = new Typecho_Widget_Helper_Form_Element_Text(
    //     'doubanId',
    //     NULL,
    //     NULL,
    //     _t('豆瓣书单'),
    //     _t('填写豆瓣id，保证项目根目录下douban_cache有可读写权限, 页面的url为reading.html')
    // );
    // $form->addInput($doubanId);

    // $RSSList = new Typecho_Widget_Helper_Form_Element_Textarea(
    //     'RSSList',
    //     NULL,
    //     NULL,
    //     _t('RSS聚合'),
    //     _t('格式:<br><span style="color: darkred">RSS标题 (空格)RSS的url (空格)缓存时间(单位秒, 不填默认6小时, 需要给主题目录下cache目录读写权限),(逗号)<br>例如:<br>微博 http://yangyoulin.com:1200/weibo/user2/2697157814?limit=4 3600,<br>我的接口就不开放了,512服务器🤣</span>')
    // );
    // $form->addInput($RSSList);
}

function themeFields($layout)
{
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'card_image',
        NULL,
        NULL,
        _t('文章顶部图片'),
        _t('在这里填入一个图片URL地址, 以在文章标题后加上背景图片<br>注意：<span style="color: red">Markdown格式下，直接在文章第一行插入图片的方法在某些情况下报错，已废弃</span>。')
    );
    $layout->addItem($logoUrl);
}


/**获取文章真正意义上的第一张图片（图片前再无其他内容）*/
function getPostThumb($obj)
{
    $content = trim($obj->content);
    $content = delStartWith($content, '<p>');
    $content = trim($content);

    if (strpos($content, '<img') === 0) {
        preg_match("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        }
    }
    return NULL;
}

/***获取文章内容图*/
function getPostHtmImg($obj)
{
    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches);
    $atts = array();
    if (isset($matches[1][0])) {
        for ($i = 0; $i < count($matches[1]); $i++) {
            $atts[] = array('name' => $obj->title . ' [' . ($i + 1) . ']', 'url' => $matches[1][$i]);
        }
    }
    return count($atts) ? $atts : NULL;
}


function RSSList($list_str)
{
    $result = [];
    $list_str = trim($list_str);
    if (empty($list_str)) {
        return $result;
    }
    $list_arr = explode(',', $list_str);

    foreach ($list_arr as $list_item) {
        $list_item = trim($list_item);
        if (!$list_item) {
            continue;
        }
        $item_info = explode(' ', $list_item);
        if (count($item_info) < 1) {
            continue;
        }

        $result_item['title'] = trim($item_info[0]);
        $result_item['url'] = trim($item_info[1]);
        if (count($item_info) >= 2) {
            $result_item['cacheTime'] = $item_info[2];
        }

        $result[] = $result_item;
    }
    return $result;
}

function drawerMenuPages()
{
    return array('about', 'links', 'board', 'reading');
}

//评论添加回复标记
function getCommentReply($parent)
{

    $db = Typecho_Db::get();
    //    $prow = $db->fetchRow($db->select('parent')->from('table.comments')
    //        ->where('coid = ? AND status = ?', $coid, 'approved'));
    //    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
            ->where('coid = ? AND status = ?', $parent, 'approved'));

        if ($arow && $arow['author']) {
            echo "<a  href=\"#comment-{$parent}\" class=\"reply-author mdl-color-text--primary\">@<b>{$arow['author']}</b></a>";
        }
    }
}

function randomMaterialColor($index = NULL)
{
    if ($index == NULL) {
        $index = rand(0, 20);
    } else if ($index < 0) {
        $index = 6;
    }
    $mdColors = array(
        '#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3',
        '#03a9f4', '#00bcd4', '#009688', '#4caf50', '#8bc34a', '#cddc39', '#ffeb3b',
        '#ffc107', '#ff9800', '#ff5722', '#795548', '#9e9e9e', '#607d8b'
    );
    echo $mdColors[$index % count($mdColors)];
}

function getOS()
{
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    if (strpos($agent, 'windows nt')) {
        $platform = 'windows';
    } elseif (strpos($agent, 'macintosh')) {
        $platform = 'mac';
    } elseif (strpos($agent, 'ipod')) {
        $platform = 'ipod';
    } elseif (strpos($agent, 'ipad')) {
        $platform = 'ipad';
    } elseif (strpos($agent, 'iphone')) {
        $platform = 'iphone';
    } elseif (strpos($agent, 'android')) {
        $platform = 'android';
    } elseif (strpos($agent, 'unix')) {
        $platform = 'unix';
    } elseif (strpos($agent, 'linux')) {
        $platform = 'linux';
    } else {
        $platform = 'other';
    }

    return $platform;
}

function delStartWith($str, $prefix)
{
    if (substr($str, 0, strlen($prefix)) == $prefix) {
        $str = substr($str, strlen($prefix));
    }
    return $str;
}

function debug_print($obj)
{
    echo '<div style="border: 1px red solid;position:fixed; top: 0; left: 0; z-index: 10000;font-size: 12px;font-style: unset;
overflow: auto;background-color: black;color: gainsboro;height: 100%;width: 100%"><pre>'
        . print_r($obj, true)
        . '</pre></div>';
}

/**插件式操作*/
//Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('MyMaterial', 'excerptEx'); //这个接口会被其他插件覆盖
//Typecho_Plugin::factory('Widget_Archive')->___allContent = array('MyMaterial', 'allContent');
//Typecho_Plugin::factory('Widget_Archive')->___simpleContent = array('MyMaterial', 'simpleContent');

class MyMaterial
{
    /**
     * 摘要文章
     * 为了过滤掉头图在文章中的显示
     * @param $obj
     * @param bool $more
     * @return string
     */
    //    function simpleContent($obj, $more = false)
    //    {
    //        $content = trim($obj->excerpt);
    //        $content = delStartWith($content, '<p>');
    //        $content = trim($content);
    //
    //        if (strpos($content, '<img') === 0) {
    /*            $content = preg_replace("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", '', $content, 1);*/
    //            $content = trim($content);
    //            $content = delStartWith($content, '</p>');
    //            $content = delStartWith($content, '<br>');
    //        } else {
    //            $content = trim($obj->excerpt);
    //        }
    //
    //        return false == $more ? $content : $content . "<p class=\"more\"><a href=\"{$obj->permalink}\" title=\"{$obj->title}\">{$more}</a></p>";
    //    }

    /**
     * 文章全部内容
     * 为了过滤掉头图在文章中的显示
     * @param $obj
     * @return string|string[]|null
     */
    //    function excerptEx($content)
    //    {
    //        $content = trim($content);
    //        $content = delStartWith($content, '<p>');
    //        $content = trim($content);
    //
    //        if (strpos($content, '<img') === 0) {
    /*            return preg_replace("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", '', $content, 1);*/
    //        }
    //        return $obj->content;
    //    }
}
