<?php

// -----------------------------------------------------------------------------
// PHPの汎用関数を読み込み
// -----------------------------------------------------------------------------
include_once(dirname(__FILE__) . "/base.php");


// -----------------------------------------------------------------------------
// ブラウザ判別用関数を読み込み
// -----------------------------------------------------------------------------
include_once(dirname(__FILE__) . "/browser.php");


// -----------------------------------------------------------------------------
// 各種フラグの設定
// -----------------------------------------------------------------------------
define('IS_DEMO', 0);       // 開発フラグ 開発時に1、公開時に0にする
define('USE_BOOTSTRAP', 0); // TwitterBootstrap を使う場合は1を
define('IS_WP', 1);         // WPのテーマとして使う場合は1を


// -----------------------------------------------------------------------------
// WP機能別のフラグ設定
// 必要な機能に1を、不要なら0を入力
// インデントされてる機能はインデント元のファイルに記述がある
// →インデント元を0にしたら効かないので注意
// -----------------------------------------------------------------------------
if ( IS_WP ) {
  define('USE_WP_BASIC', 1);            // とりあえず入れとけ的な
    define('USE_WP_TW_LINK', 0);        // ツイッターアカウントを自動でリンク
    define('USE_WP_ADMIN_DELETE', 1);   // 管理画面の余計なもの非表示
    define('USE_WP_THUMBNAILS', 0);     // アイキャッチ
    define('USE_WP_SIMGLE_PARAM', 0);   // 個別ページのテンプレをパラメータで変更
    define('USE_WP_IS_XXX', 1);         // is_XXX の関数を追加で作る

  define('USE_WP_CUSTUM_HEADER', 0);    // カスタムヘッダー

  define('USE_WP_WIDGETS', 0);          // ウィジェット使用
    define('USE_WP_WIDGETS_CUSTOM', 0); // ウィジェットのカスタム

  define('USE_WP_BREADCRUMB', 0);       // パンくず使用
  define('USE_WP_RECOMMEND', 0);        // 関連記事表示

  define('USE_WP_CUSTOMPOSTTYPE', 0);   // カスタム投稿タイプ
  define('USE_WP_TAXONOMIES', 0);       // カスタム分類
}

// とりあえず入れとけ的な
if ( USE_WP_BASIC ) {
  $wpbs = dirname(__FILE__) . "/wp/base.php";
  if (file_exists($wpbs)) {
    include_once($wpbs);
  }
}

// カスタムヘッダー
if ( USE_WP_CUSTUM_HEADER ) {
  $wpch = dirname(__FILE__) . "/wp/customHeader.php";
  if (file_exists($wpch)) {
    include_once($wpch);
  }
}

// ウィジェット使用
if ( USE_WP_WIDGETS ) {
  $wpwg = dirname(__FILE__) . "/wp/widgets.php";
  if (file_exists($wpwg)) {
    include_once($wpwg);
  }
}

// パンくず使用
if ( USE_WP_BREADCRUMB ) {
  $wpbc = dirname(__FILE__) . "/wp/breadCrumb.php";
  if (file_exists($wpbc)) {
    include_once($wpbc);
  }
}

// 関連記事表示
if ( USE_WP_RECOMMEND ) {
  $wprc = dirname(__FILE__) . "/wp/recommend.php";
  if (file_exists($wprc)) {
    include_once($wprc);
  }
}

// カスタム投稿タイプ
if ( USE_WP_CUSTOMPOSTTYPE ) {
  $wpcp = dirname(__FILE__) . "/wp/customPostType.php";
  if (file_exists($wpcp)) {
    include_once($wpcp);
  }
}

// カスタム分類
if ( USE_WP_TAXONOMIES ) {
  $wpct = dirname(__FILE__) . "/wp/customTaxonomies.php";
  if (file_exists($wpct)) {
    include_once($wpct);
  }
}

// テスト用
if ( IS_DEMO ) {
  ini_set( 'display_errors', 1 );
}

// TwitterBootstrap を使ってる用の関数作成
function use_bootstrap () {
  if ( USE_BOOTSTRAP ) {
    return true;
  } else {
    return false;
  }
}
