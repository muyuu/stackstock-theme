<?php

/* ----------------------------
 * カスタム分類を使う場合にこのファイルを使用
 ---------------------------- */

// -----------------------------------------------------------------------------
// カスタム分類登録
// -----------------------------------------------------------------------------
add_action( 'init', 'create_type_taxonomies', 0 );
function create_type_taxonomies() {
  $labels = array(
    'name' => _x( '種類', 'taxonomy general name' ),
    'singular_name' => _x( '種類', 'taxonomy singular name' ),
    'search_items' =>  __( '種類を探す' ),
    'popular_items' => __( 'よく対応してる種類' ),
    'all_items' => __( '全ての種類' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( '種類を編集' ),
    'update_item' => __( '種類をアップデート' ),
    'add_new_item' => __( '種類を新しく追加' ),
    'new_item_name' => __( '新しい種類の名前' ),
    'separate_items_with_commas' => __( 'コンマで区切ってください' ),
    'add_or_remove_items' => __( '種類の追加または削除' ),
    'choose_from_most_used' => __( '最も使用している種類' )
  ); 

  register_taxonomy('type','project',array(
    'hierarchical' => true, // 階層化の可否
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
}