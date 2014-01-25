<?php
/*
 * パンくずを表示
 * by  @WebDesignRecipe さん
 * via http://webdesignrecipes.com/wordpress-breadcrumb-list-tips/
 */
function breadcrumb(){
  global $post;
  $str ='';
  $li = '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
  $span = '<span itemprop="title">';

  if(!is_home()&&!is_admin()){ 

    // ホーム、管理ページ以外に nav と ul でパンくずを作成
    $str.= '<nav class="breadCrumb">'."\n";
    $str.= '<ul>'."\n";

    // 第一階層 ホームのli作成
    $str.= $li.'<a href="'. home_url() .'/" itemprop="url">'.$span.'HOME</span></a></li>'."\n";
    
    // -------------------------------------------------------------------------------
    // 第二階層以降はページの内容(検索結果なのかカテゴリーなのか)によって変更する
    // -------------------------------------------------------------------------------

    // 検索の場合は「～で検索した結果」のみ
    if(is_search()){
      $str.= '<li>「'. get_search_query() .'」で検索した結果</li>'."\n";

    // 特定のタグの場合は「～関連のページ」のみ
    } elseif(is_tag()){
      $str.= '<li>'. single_tag_title( '' , false ). '関連のページ</li>'."\n";

    // ↓↓Divemate用 カスタム分類ページ対応
    } elseif(is_tax()){
      $str.= $li . '<a href="/appli/" itemprop="url">'.$span. "アプリ" . '</span></a></li>'."\n";
      $str.= $li . '<a href="/device/" itemprop="url">'.$span. "対応端末一覧" . '</span></a></li>'."\n";
      $str.= '<li>'. single_tag_title( '' , false ). '</li>'."\n";
    // ↑↑カスタム分類ページ用

    // 404の場合は「404」のみ
    } elseif(is_404()){
      $str.='<li>404 Not found</li>'."\n";

    // 日付アーカイブの場合は「年」「月」「日」ごとに li で区切る
    // 一番最後の項目が何かによって最後の項目にはaタグなしで
    } elseif(is_date()){
      if(get_query_var('day') != 0){
        $str.= $li.'<a href="'. get_year_link(get_query_var('year')). '" itemprop="url">'.$span. get_query_var('year'). '年</span></a></li>'."\n";
        $str.= $li.'<a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '" itemprop="url">'.$span; get_query_var('monthnum') .'月</span></a></li>'."\n";
        $str.= '<li>'. get_query_var('day'). '日</li>'."\n";
      } elseif(get_query_var('monthnum') != 0){
        $str.= $li.'<a href="'. get_year_link(get_query_var('year')) .'" itemprop="url">'.$span. get_query_var('year') .'年</span></a></li>'."\n";
        $str.='<li>'. get_query_var('monthnum'). '月</li>'."\n";
      } else {
        $str.='<li>'. get_query_var('year') .'年</li>'."\n";
      }

    // カテゴリーアーカイブの場合はカテゴリー名をliで区切る
    } elseif(is_category()) {
      $cat = get_queried_object();
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.= $li.'<a href="'. get_category_link($ancestor) .'" itemprop="url">'.$span. get_cat_name($ancestor) .'</span></a></li>'."\n";
        }
      }
      $str.='<li>'. $cat -> name . '</li>'."\n";

    // 投稿者ページの場合は投稿者名を表示
    } elseif(is_author()){
      $str .='<li>投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</li>'."\n";

    // 個別ページの場合は階層に従って liを生成
    } elseif(is_page()){
      if($post -> post_parent != 0 ){
        $ancestors = array_reverse(get_post_ancestors( $post->ID ));
        foreach($ancestors as $ancestor){
          $str.= $li.'<a href="'. get_permalink($ancestor).'" itemprop="url">'.$span. get_the_title($ancestor) .'</span></a></li>'."\n";
        }
      }
      $str.= '<li>'. $post -> post_title .'</li>'."\n";

    // コレナニ？
    } elseif(is_attachment()){
      if($post -> post_parent != 0 ){
        $str.= $li.'<a href="'. get_permalink($post -> post_parent).'" itemprop="url">'.$span. get_the_title($post -> post_parent) .'</span></a></li>'."\n";
      }
      $str.= '<li>' . $post -> post_title . '</li>'."\n";

    // コベツページの場合はカテゴリーをliとする
    } elseif(is_single()){
      $categories = get_the_category($post->ID);
      $cat = $categories[0];
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.= $li.'<a href="'. get_category_link($ancestor).'" itemprop="url">'.$span. get_cat_name($ancestor). '</span></a></li>'."\n";
        }
      }

      // ↓↓ Divemate用 カスタム投稿タイプ対策
      if(get_post_type()=='news') {
        $str.= $li.'<a href="/news/" itemprop="url">'.$span. "新着情報" . '</span></a></li>'."\n";
      } else if(get_post_type()=='appli') {
        $str.= $li.'<a href="/appli/" itemprop="url">'.$span. "アプリ" . '</span></a></li>'."\n";
      // ↑↑ Divemate用 カスタム投稿タイプ対策

      } else {
        $str.= $li.'<a href="'. get_category_link($cat -> term_id). '" itemprop="url">'.$span. $cat-> cat_name . '</span></a></li>'."\n";
      }
      $str.= '<li>'. $post -> post_title .'</li>'."\n";
    } elseif(is_archive()){
      if(get_post_type()=='news') {
        $str.= "<li>新着情報</li>\n";
      } else if(get_post_type()=='appli') {
        $str.= "<li>アプリ</li>\n";
      } else {
        $str.= "<li>指定なし</li>\n";
      }
    } else{
      $str.='<li>'. wp_title('', true) .'</li>'."\n";
    }
    $str.='</ul>'."\n";
    $str.='</nav>';
  }
  echo $str;
}

