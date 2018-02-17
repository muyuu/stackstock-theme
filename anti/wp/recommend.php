<?php
//----------------------------------------------------
// 関連記事を出力する
// IN：カテゴリ・タグからそれぞれ取得する件数
//   取得する際に並び変えるキー
//   取得順（ASC or DESC）
//   最終的に並び変えるキー（ID or post_date）
//   並び変える順（ASC or DESC）
// OUT:関連記事のリスト出力
//----------------------------------------------------
function the_recommend($show_post='5',$order_key='ID',$order_by='DESC',$sort_key = 'ID',$sort_by='DESC') {
	//ループ変数初期化 
	$i=0;
	// 重複チェック用パーマリンク変数初期化
	$permalink = array();
	// 表示している記事のパーマリンクを格納する
	$permalink[] = get_permalink();
	// 関連記事格納用変数初期化
	$posts = array();

	// 数値以外だったらエラー防止のためにデフォルト値をセットする
	if(!is_numeric($show_post)) {
		$show_post = '5';
	}

	// 基準キーが空だったら、デフォルト値をセットする
	if(empty($order_key)) {
		$order_key = 'ID';
	}

	// 基準キー順がASC・DESCでなかったらデフォルト値をセットする
	if($order_by != 'ASC' && $order_by != 'DESC') {
		$order_by = 'DESC';
	}

	// 並び変えキーがID・post_dateでなかったらデフォルト値をセットする
	if($sort_key != 'ID' && $sort_key != 'post_date') {
		$sort_key = 'ID';
	}

	// 並び変え順がASC・DESCでなかったらデフォルト値をセットする
	if($sort_by != 'ASC' && $sort_by != 'DESC') {
		$sort_by = 'DESC';
	}

	// 最終的な並び順によって変数の中身を変える
	if($sort_by == 'ASC') {
		$sort_by = SORT_ASC;
	}
	else {
		$sort_by = SORT_DESC;
	}

	// カテゴリを取得して変数に格納する
	$cats = get_the_category();

	// カテゴリがついてたら実行する
	if($cats) {
		// 記事についてるカテゴリ分繰り返す
		foreach($cats as $cat) {
			$cat_id = $cat->cat_ID ;
			$query = 'cat=' . $cat_id. '&post_status=publish&showposts='.$show_post.'&orderby='.$order_key.'&order='.$order_by;
			query_posts($query) ;
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				if(!in_array(get_permalink(),$permalink)) {
					$permalink[] = get_permalink();
					$posts[$i]['ID'] = get_the_ID();
					$posts[$i]['title'] = the_title(NULL,NULL,false);
					$posts[$i]['permalink'] = get_permalink();
					$posts[$i]['post_date'] = get_the_date("Ymd");
					++$i;
				}
			endwhile; endif;
			// クエリリセット
			wp_reset_query();
		}
	}


	// タグを変数に格納する
	$tags = get_the_tags();

	// タグがついてたら実行する
	if($tags) {
		// 記事についてるタグ分繰り返す
		foreach($tags as $tag) {
			$tag_id = $tag->term_id;
			$query = 'tag__in=' . $tag_id. '&post_status=publish&showposts='.$show_post.'&orderby='.$order_key.'&order='.$order_by;
			query_posts($query) ;
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				if(!in_array(get_permalink(),$permalink)) {
					$permalink[] = get_permalink();
					$posts[$i]['ID'] = get_the_ID();
					$posts[$i]['title'] = the_title(NULL,NULL,false);
					$posts[$i]['permalink'] = get_permalink();
					$posts[$i]['post_date'] = get_the_date("Ymd");
					++$i;
				}
			endwhile; endif;
			// クエリリセット
			wp_reset_query();
		}
	}

	// 関連記事が1件以上あったら出力する。
	if(is_array($posts) && count($posts) > 0) {
		// ソートするために変数にキーと値を格納する
		foreach ($posts as $key => $row) {
			$sort[$key] = $row[$sort_key];
		}

		// ソートする
		array_multisort($sort,$sort_by,$posts);

		echo '<ul id="related_article">';
		// 最後に出力する
		foreach($posts as $related_article) {
			echo <<<EOF
			<li><a href="{$related_article['permalink']}">{$related_article['title']}</a></li>
EOF;
		}
		echo '</ul>';
	}
	// 関連記事がなかったらなかった場合の出力をする。
	else {
		echo '関連記事は見つかりませんでした';
	}
}
