<?php

/* ----------------------------
 * カスタム投稿タイプを使う場合にこのファイルを使用
 ---------------------------- */

// -----------------------------------------------------------------------------
// 事業内容
// -----------------------------------------------------------------------------
add_action('init', 'project_post_init');
function project_post_init()
{
  $labels = array(
    'name' => _x('事業内容', 'post type general name'),
    'singular_name' => _x('事業内容', 'post type singular name'),
    'add_new' => _x('事業内容を追加する', 'project'),
    'add_new_item' => __('事業内容を書く'),
    'edit_item' => __('事業内容を編集'),
    'new_item' => __('事業内容'),
    'view_item' => __('事業内容を見る'),
    'search_items' => __('事業内容を探す'),
    'not_found' =>  __('事業内容はありません'),
    'not_found_in_trash' => __('ゴミ箱に事業内容はありません'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail','custom-fields','excerpt','author','trackbacks','comments','revisions','page-attributes'),
    'has_archive' => true
  );
  register_post_type('project',$args);
}

//投稿時のメッセージとか
add_filter('post_updated_messages', 'project_updated_messages');
function project_updated_messages( $messages )
{
  $messages['project'] = array(
    0 => '', // ここは使用しません
    1 => sprintf( __('事業内容を更新しました <a href="%s">記事を見る</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('カスタムフィールドを更新しました'),
    3 => __('カスタムフィールドを削除しました'),
    4 => __('事業内容更新'),
    5 => isset($_GET['revision']) ? sprintf( __(' %s 前に事業内容を保存しました'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('事業内容が公開されました <a href="%s">記事を見る</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('事業内容記事を保存'),
    8 => sprintf( __('事業内容記事を送信 <a target="_blank" href="%s">プレビュー</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('事業内容を予約投稿しました: <strong>%1$s</strong>. <a target="_blank" href="%2$s">プレビュー</a>'),
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('事業内容の下書きを更新しました <a target="_blank" href="%s">プレビュー</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}

//追加したカスタム投稿タイプの投稿ページ上部にあるプルダウンするヘルプ内テキスト
add_action( 'contextual_help', 'add_help_text', 10, 3 );

function add_help_text($contextual_help, $screen_id, $screen)
{ 
  if ('project' == $screen->id )
  {
    $contextual_help =
      '<p>' . __('事業内容の追加方法') . '</p>' .
      '<ul>' .
      '<li>' . __('タイトルを入力します') . '</li>' .
      '<li>' . __('本文を入力します') . '</li>' .
      '<li>' . __('カテゴリー(事業の分類)を選択します') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('解決しないときは:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">ドキュメント</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">フォーラム</a>') . '</p>' ;
  } elseif ( 'edit-book' == $screen->id )
  {
    $contextual_help =
      '<p>' . __('カスタム投稿タイプむずいようで簡単ですね。でも僕にはむずいです。') . '</p>' ;
  }
  return $contextual_help;
}


