<?php

// -----------------------------------------------------------------------------
// CPライブラリ読み込み
// -----------------------------------------------------------------------------
include_once (dirname(__FILE__) . "/anti/anti.php");


// -----------------------------------------------------------------------------
// twitterライブラリ読み込み
// -----------------------------------------------------------------------------
require_once(dirname(__FILE__) . '/anti/twitteroauth/twitteroauth.php');

//twitterAppsで取得
$consumerKey = 'mMxXUVN0irFRnn42ROgQIQ';
$consumerSecret = 'J7AZjMVVkAt9a4cOZfqjvRaeej5UtGPYWIaJfQIfj9I';
$accessToken = '3725841-XfXeKpedAvGFXMc7m53zAtX8NKfxvpk9tO5UGwIEgQ';
$accessTokenSecret = 'N1SOhi8rrU0zzNlPkpcSmpO0cAo6SdUqJfIbEiJuOY';

$twObj = new TwitterOAuth(
    $consumerKey,
    $consumerSecret,
    $accessToken,
    $accessTokenSecret
);


//OGPの設定
get_template_part('ogp');
//FBのユーザーIDとアプリIDを設定
$og_userid  = "1061461410";
$og_appliid = "302143453164759";
//画像設定(アイキャッチ -> 0 固定画像 -> 1)
$og_img_flg = 1;
//画像のパス設定(デフォルトは[images/default.gif])
$og_img_url = "i/ogp_image.gif";
add_action ('wp_head','print_ogp');

//アイキャッチ使うよ
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 260, 200, true );

//ソーシャルサービスのアカウントを記載してください
//ここを変えるとヘッダーとフッターにリンクとかが付きますよ
//Twitter のアカウント
$tw_screen_name = "muyuu_";
//facebook のアカウント
$fb_user_name = "muyuu";
//Delicious のアカウント
$deli_user_name = "muyuu";

// ソーシャルアカウント用関数
function is_tw_name() {
    global $tw_screen_name;
    if ( $tw_screen_name != "" ) {
        return true;
    } else {
        return false;
    }
}
function get_tw_name() {
    global $tw_screen_name;
    if ( $tw_screen_name != "" ) {
        return $tw_screen_name;
    } else {
        return false;
    }
}
function tw_name() {
    global $tw_screen_name;
    echo ($tw_screen_name);
}
function is_fb_name() {
    global $fb_user_name;
    if ( $fb_user_name != "" ) {
        return true;
    } else {
        return false;
    }
}
function get_fb_name() {
    global $fb_user_name;
    if ( $fb_user_name != "" ) {
        return $fb_user_name;
    } else {
        return false;
    }
}
function fb_name() {
    global $fb_user_name;
    echo ( $fb_user_name );
}
function is_deli_name() {
    global $deli_user_name;
    if ( $deli_user_name != "" ) {
        return true;
    } else {
        return false;
    }
}
function get_deli_name() {
    global $deli_user_name;
    if ( $deli_user_name != "" ) {
        return $deli_user_name;
    } else {
        return false;
    }
}
function deli_name() {
    global $deli_user_name;
    echo ( $deli_user_name );
}

//サイドバーの表示設定
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<section id=%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget_title">',
        'after_title' => '</h2>',
    ));
}

//ウィジェットのタグクラウド設定を変更
function tag_cloud_filter ($arg = array() ) {
    $args['unit']     = '%';    // smallest・largest の値の単位
    $args['smallest'] = 80;     // 最小文字サイズは 80%
    $args['largest']  = 150;    // 最大文字サイズは 150%
    $args['number']   = 80;      // 全タグ表示
    $args['orderby']  = 'count'; // 表示順はランダムで
    $args['order']    = 'DESC'; // 表示順はランダムで
    return $args;
}
add_filter('widget_tag_cloud_args', 'tag_cloud_filter');

//ウィジェットのカテゴリー設定を変更
function category_filter ($arg = array() ) {
    $args['title_li']              = '';
    $args['depth']              = 0;
    return $args;
}
add_filter('widget_categories_args', 'category_filter');

//最近のつぶやきを取得(フッター用)
//件数を変えたいときは4行下の count= の数字を変えてください
function get_recent_tweet ($screen_name) {
    global $twObj;
    $json = $twObj->OAuthRequest(
        'https://api.twitter.com/1.1/statuses/user_timeline.json',
        'GET',
        array('screen_name'=>$screen_name, 'count'=>3)
    );
    $rss = json_decode($json, true);
    // var_dump($json);
    // var_dump($rss);
    return $rss;
}

function recent_tweet ($screen_name) {
    $rss = get_recent_tweet( $screen_name );

    foreach ($rss->status as $i) {
        $val = preg_replace("/((http|https):\/\/(([A-Za-z1-9\-_]+\.)+[a-z]{2,3}(\/[1-9a-z\-\/\._\?=&%\[\]]+)))/i", "<a href='$1' target='_blank'>$1</a>", $i->text);
        $val = preg_replace("/@([a-zA-Z0-9-_]{1,})/", "<a href='http://twitter.com/$1/' target='_blank'>@$1</a>", $val);
        echo ('<article class="tweet">'.$val.'</article>');
    }
}

//Twitterのプロフィール取得
function get_twitter_profile($screen_name){
    global $twObj;
    $json = $twObj->OAuthRequest(
        'https://api.twitter.com/1.1/users/show.json',
        'GET',
        array('screen_name'=>$screen_name)
    );
    $rss = json_decode($json, true);
    // var_dump($json);
    // var_dump($rss);
    return $rss;
}

//Twitterのアイコン取得
function get_twitter_icon($screen_name){
    $prof = get_twitter_profile($screen_name);
    return $prof['profile_image_url'];
}
//Twitterのアイコン取得
function twitter_icon($screen_name){
    $url = get_twitter_icon($screen_name);
    echo "<img src=\"" . $url . '">';
}

//Twitterのユーザー名取得
function get_twitter_name($screen_name){
    $prof = get_twitter_profile($screen_name);
    return $prof['name'];
}
//Twitterのユーザー名取得
function twitter_name($screen_name){
    $name = get_twitter_name($screen_name);
    echo $name;
}
