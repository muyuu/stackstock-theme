<?php

/* ----------------------------
 * カスタムヘッダーを使う場合にこのファイルを使用
 ---------------------------- */

// -----------------------------------------------------------------------------
//ヘッダー画像のcss追加
// -----------------------------------------------------------------------------
function header_style() { ?>
    <style type="text/css">
        #header {
            background: url(<?php header_image(); ?>);
        }
    </style><?php
}

add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support('menus');
add_theme_support('automatic-feed-links');

define('HEADER_TEXTCOLOR', 'ffffff');
define('HEADER_IMAGE', '%s/images/default_header.jpg'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH','950'); //横サイズ指定
define('HEADER_IMAGE_HEIGHT','200'); //縦サイズ指定

