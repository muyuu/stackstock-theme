<?php

/*
 * is_xxxx() をいっぱい作っておく関数
 * 特定のカテゴリ配下のページの場合だけ true にする感じ
 */

/*
 * 作りたい条件分岐

 * // ホームページ
 * is_home() ホームか否か (既存)

 * // 別腹
 * is_post_type("postname") 投稿タイプ判別

 * // 個別記事
 * is_single()  個別記事か否か (既存)
 * is_single_type () 個別記事か否か(投稿タイプ別)
 
 * // アーカイブページ
 * is_archive () アーカイブページか否か (既存)
 * is_archive_type () アーカイブページか否か(投稿タイプ別)

 * // カテゴリー関連
 * is_category() カテゴリーのアーカイブページか否か (既存)
 * in_category() 現在の投稿に指定したカテゴリーが割り当てられているか (既存)
 * have_parent_category() 指定された親カテゴリに属するか否か

 * // タグ関連
 * is_tag() 指定されたタグのアーカイブページ (既存)
 * have_tag() 指定されたタグを持っているか否か

 * // 固定ページ関連
 * is_page() 固定ページか否か (既存)
 * have_parent_page() 指定されたページに属するか否か

 */


/*
 * 投稿タイプ判別
 * 通常投稿 -> "post"
 * カスタム投稿 -> "postname"
 */
function is_post_type ( $name ) {
  if ( get_post_type() == $name ) {
    // 投稿タイプが「news」を表示してる時
    return $name;
  } else {
    return false;
  }
}

/*
 * 指定した投稿タイプの個別ページか否か
 */
function is_single_type ( $posttype = "post" ) {
  if ( is_single() ) {
    if ( is_post_type( $posttype ) ) {
      return true;
    }
  }
  return false;
}

/*
 * 指定した投稿タイプのアーカイブページか否か
 */
function is_archive_type ( $posttype = "post" ) {
  if ( is_archive() ) {
    if ( is_post_type( $posttype ) ) {
      return true;
    }
  }
  return false;
}

/*
 * 指定された親カテゴリに属するか否か
 */
function have_parent_cateogory ( $parent ) {
  $post_cats = get_the_category();
  if ( $post_cats[0]->cat_ID == $parent ||
       $post_cats[0]->category_parent == $parent || 
       cat_is_ancestor_of( $parent, (int)$post_cats[0]->category_parent ) ) {
    return true;
  }
  return false;
}

/*
 * 指定された固定ページの親子関係か否か
 */
function in_page ( $pid = "" ) {
  // ↓ ループの外の場合にのみ記載
  global $post;

  // ↓現在のページが固定ページだったらOK
  if ( is_page( $pid ) ) {
    return true;
  }
  // ↓現在のページの祖先ページIDを取得(配列)
  $anc = get_post_ancestors( $post->ID );

  // ↓指定された$pidと正しい祖先ページIDがあればOK
  foreach ( $anc as $ancestor ) {
    if( is_page() && $ancestor == $pid ) {
      return true;
    }
  }
  return false;
}

