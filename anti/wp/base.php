<?php

/* ----------------------------
 * WordPress の汎用関数をまとめました
 ---------------------------- */

// とりあえず入れとけ的な
if ( USE_WP_IS_XXX ) {
  $wpxx = dirname(__FILE__) . "/is_xxx.php";
  if (file_exists($wpxx)) {
    include_once($wpxx);
  }
}


// -----------------------------------------------------------------------------
//headで生成される余計なタグを削除
// -----------------------------------------------------------------------------
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );


// -----------------------------------------------------------------------------
// RSSフィードリンクを表示
// -----------------------------------------------------------------------------
add_theme_support('automatic-feed-links');


// -----------------------------------------------------------------------------
// 抜粋の共通項目
// -----------------------------------------------------------------------------

// 抜粋の長さを変える
function new_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

//抜粋の後に来る[...]の変更
function new_excerpt_more($more) {
  return '[.....]';
}
add_filter('excerpt_more', 'new_excerpt_more');


// -----------------------------------------------------------------------------
//本文の頭から何文字目までを表示する
// -----------------------------------------------------------------------------
function CP_get_excerpt ( $array ) {
    //引数の定義
    /*
        $array['num']  = 何文字目まで表示するか
        $array['mark'] = 続き文字を何にするか
    */

    //引数のデフォルト設定
    $num = 40;
    //引数が設定されていればそれに合わせるよ
    if ( $array['num'] ) {
        $num = $array['num'];
    }

    $mark = "[...]";
    //引数が設定されていればそれに合わせるよ
    if ( $array['mark'] ) {
        $mark = $array['mark'];
    }

    //抜粋を$excerptに保存
    $excerpt = get_the_excerpt();
    //抜粋の文字数を取得して$countに保存
    $count = mb_strlen($excerpt );

    //もし文字数が引数分を超えてたら
    if ( $count > $num ) {
        //抜粋を0文字目から引数文字目までにする
        $excerpt = mb_substr ( $excerpt, 0, $num);
        //引数文字にした抜粋を表示
        echo $excerpt . $mark;
    } else {
        //引数文字以内だったら
        //そのまま表示
        echo $excerpt;
    }
}

// -----------------------------------------------------------------------------
// 子カテゴリー判断用ライブラリ
// -----------------------------------------------------------------------------
/* 使用方法
<?php if ( post_is_in_descendant_category( 30 ) ) { ?>
    <!-- カテゴリーIDが30のカテゴリーの子カテゴリーだった場合、-->
    <!-- ここに書かれている処理を実行する -->
<?php } ?>
*/
function post_is_in_descendant_category( $cats, $_post = null ) {
  foreach ( (array) $cats as $cat ) {
    // get_term_children() accepts integer ID only
    $descendants = get_term_children( (int) $cat, 'category');
    if ( $descendants && in_category( $descendants, $_post ) ) {
      return true;
    }
  }
  return false;
}

// -----------------------------------------------------------------------------
// 子ページか否か（個別ページ）
// -----------------------------------------------------------------------------
function is_subpage() {
  global $post;

  // 現在の固定ページが親ページを持つかどうか
  if ( is_page() && $post->post_parent ){
    // 親ページの ID を取得
    $parentID = $post->post_parent;
    // スラッグを取得
    $parentSlug = get_page_uri($parentID);
    // 親ページのスラッグを返す
    return $parentSlug;

  // 親ページを持っていない場合
  } else {
    return false;
  }
}

// -----------------------------------------------------------------------------
// ～配下のページか否か
// -----------------------------------------------------------------------------
/*
function in_page ($slug) {
  if ( is_page($slug) || is_subpage() == $slug) {
    return true;
  } else {
    return false;
  }
}
*/

// -----------------------------------------------------------------------------
// 本文のtwアカウント( @alphabet ) をaタグで囲む
// -----------------------------------------------------------------------------
if ( USE_WP_TW_LINK ) {
  function add_twitter_link($content) {
    $pattern= '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9_]+)/i';
    $replace= '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>';
    $content= preg_replace($pattern, $replace, $content);
    return $content;
  }
  add_filter( "the_content", "add_twitter_link" );
}


// -----------------------------------------------------------------------------
// 管理画面で不要なものを非表示にする
// -----------------------------------------------------------------------------
if ( USE_WP_ADMIN_DELETE ) {
  // 投稿
  function remove_default_post_screen_metaboxes() {
    remove_meta_box( 'postcustom','post','normal' ); // カスタムフィールド
    remove_meta_box( 'postexcerpt','post','normal' ); // 抜粋
    remove_meta_box( 'commentstatusdiv','post','normal' ); // コメント
    remove_meta_box( 'trackbacksdiv','post','normal' ); // トラバ
    remove_meta_box( 'slugdiv','post','normal' ); // スラッグ
    remove_meta_box( 'authordiv','post','normal' ); // 著者
  }
  add_action('admin_menu','remove_default_post_screen_metaboxes');

  // 固定ページ
  function remove_default_page_screen_metaboxes() {
    remove_meta_box( 'postcustom','page','normal' ); // カスタムフィールド
    remove_meta_box( 'postexcerpt','page','normal' ); // 抜粋
    remove_meta_box( 'commentstatusdiv','page','normal' ); // コメント
    remove_meta_box( 'trackbacksdiv','page','normal' ); // トラバ
    remove_meta_box( 'slugdiv','page','normal' ); // スラッグ
    remove_meta_box( 'authordiv','page','normal' ); // 著者
  }
  add_action('admin_menu','remove_default_page_screen_metaboxes');
}


// -----------------------------------------------------------------------------
// アイキャッチの使用
// -----------------------------------------------------------------------------
if ( USE_WP_THUMBNAILS ) {
  function mysetup() {
    add_theme_support( 'post-thumbnails' );
  }
  add_action( 'after_setup_theme', 'mysetup' );
}


// -----------------------------------------------------------------------------
// 開発フラグ
// -----------------------------------------------------------------------------
if ( USE_WP_SIMGLE_PARAM ) {
  /*
   * パラメータでシングルページのテンプレートを変更
   * by  @wokamoto さん
   * via http://dogmap.jp/2011/02/01/single-template-switch/
   */
  function single_template_switch($template) {
    $new_template = $template;
    if (isset($_GET['type'])) {
      $new_template = 'single-' . esc_html($_GET['type']) . '.php';
      if (is_array($template)) {
        $new_template = array(
          $new_template,
          isset($template[1]) ? $template[1] : 'single.php'
        );
      } else {
        $new_template = preg_replace('/[^\/]+\.php$/i', $new_template, $template);
        if (!file_exists($new_template)) {
          $new_template = $template;
        }
      }
    }
    return $new_template;
  }
  add_filter('single_template', 'single_template_switch');
}


// -----------------------------------------------------------------------------
// 年別アーカイブリンクで「～年」までリンク内に入れる
// wp_get_archives(‘type=yearly&after=年’); で入るようにするよ
// -----------------------------------------------------------------------------
function my_archives_link($html){
  return preg_replace('@</a>(.+?)</li>@', '\1</a></li>', $html);
}
add_filter('get_archives_link', 'my_archives_link');

