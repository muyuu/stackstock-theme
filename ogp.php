<?php

function print_ogp() {

    //おまじない
    global $post;
    global $og_userid;
    global $og_appliid;
    global $og_img_flg;
    global $og_img_url;

    //サムネイル画像は何を使用するかの設定
    //未設定か0だったらアイキャッチ
    if ( $og_img_flg == "" || $og_img_flg == 0 ) {
        $og_img_flg = 0;
    } else {
        $og_img_flg = 1;
    }

    //固定画像のパス
    //未設定だったら「images/ogp_default.png」
    if ( $og_img_url == "" ) {
        $static_img = get_template_directory_uri()."/images/ogp_default.gif";
    } else {
        $static_img = get_template_directory_uri()."/".$og_img_url;
    }

    //実際に固定画像がない場合は画像未使用

    //個別記事の場合は設定に基づくサムネイルを設定
    if ( is_single() ) {
        if ( $og_img_flg == 0 ) {
            //アイキャッチを取得
            $og_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
            $og_img = $og_src[0];

            //アイキャッチねーじゃねーか！の時のために
            if ( ! $og_img ) {
                //記事内で最初に表示されている画像ファイルを取得
                $pattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
                preg_match ($pattern, $post->post_content, $matches);

                if ( $matches ) {
                    $og_img = $matches[2];
                } else {
                    $og_img = "";
                }
            }
        } else {
            $og_img = $static_img;
        }
    } else {
        $og_img = $static_img;
    }

    //個別と単一ページでタイプ、概要、URLを出し分け
    if ( is_single() ) {
        $og_title = "SS|" . get_the_title();
        $og_type  = "article";
        //個別記事の記事本文をOGP用に整形
        $og_desc  = $post->post_content;
        //改行削除
        $og_desc  = preg_replace("/[\n|\r|\r\n]/", "", $og_desc);
        //ショートコード削除
        $og_desc  = preg_replace("/\[.*?\]/", "", $og_desc);
        //200文字までにしてhtmlタグを削除
        $og_desc  = mb_substr(strip_tags($og_desc), 0, 200);
        $og_url   = get_permalink();
    } else if ( is_home() ) {
        $og_title = get_bloginfo('name');
        $og_type  = "blog";
        $og_desc  = get_bloginfo('description');
        $og_url   = get_bloginfo('url');
    }

    //表示
    echo("\n\n".'<!-- BEGIN Google+ -->'."\n");
    echo('<meta itemprop="name" content="'. $og_title .'">'."\n");
    if ( @fopen( $og_img, 'r' ) ) {
        echo('<meta itemprop="image" content="'. $og_img .'">'."\n");
    }
    echo('<meta itemprop="description" content="'. $og_desc .'">'."\n");
    echo('<!-- END Google+ -->'."\n\n");

    echo("\n\n".'<!-- BEGIN OGP -->'."\n");
    echo('<meta property="og:title" content="'. $og_title .'" />'."\n");
    echo('<meta property="og:type" content="'. $og_type .'" />'."\n");
    if ( @fopen( $og_img, 'r' ) ) {
        echo('<meta property="og:image" content="'. $og_img .'" />'."\n");
        echo('<meta property="image_src" content="'. $og_img .'" />'."\n");
    }
    echo('<meta property="og:url" content="'. $og_url .'" />'."\n");
    echo('<meta property="og:site_name" content="'.get_bloginfo('name')."\" />\n");
    echo('<meta property="fb:admins" content="'. $og_userid .'" />'."\n");
    echo('<meta property="fb:app_id" content="'. $og_appliid .'" />'."\n");
    echo('<meta property="og:description" content="'. $og_desc .'" />'."\n");
    echo('<!-- END OGP -->'."\n\n");
}

