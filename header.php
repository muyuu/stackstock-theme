<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8 ie7"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9 ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="ja" class="no-js" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SS | <?php wp_title(''); ?><?php if( ! wp_title('', false)) { bloginfo('name'); } ?></title>
<meta name="description" content="<?php bloginfo('description');?>" />
<meta name="keywords" content="web制作, javascript, css, html, php, git, frontend, stackstock" />

<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/libs/font-awesome/css/font-awesome.min.css">
<link href='//fonts.googleapis.com/css?family=Source+Code+Pro' rel='stylesheet' type='text/css'>
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('atom_url'); ?>">

<?php wp_enqueue_script('jquery');?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); if( is_single() || is_tag() || $_GET['s']){ ?> id="single" <?php }?>>

<header class="pageheader">
  <div class="container">
    <div class="site_info">
    <?php if(is_home()): // ホームの場合はブログタイトルがH1 ?>
    <h1 class="sitename"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
    <?php else: // ホーム以外の場合は記事タイトルがH1 ?>
    <p class="sitename"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
    <?php endif; ?>
    <p class="description"><?php bloginfo('description'); ?></p>
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    </div>
    <ul class="icon">
    <?php if( is_tw_name() ) { ?>
    <li class="twitter"><a href="http://twitter.com/#!/<?php tw_name(); ?>" target="_blank">
      <i class="fa-twitter-square icon-3x"></i>
    </a></li>
    <?php } ?>
    <?php if( is_fb_name() ) : ?>
    <li class="facebook"><a href="http://www.facebook.com/<?php fb_name(); ?>" target="_blank">
      <i class="fa-facebook-square icon-3x"></i>
    </a></li>
    <?php endif; ?>
    <li class="rss" ><a href="<?php bloginfo('atom_url'); ?>" target="_blank">
      <i class="fa-rss-square icon-3x"></i>
    </a></li>
    </div>
  </div>
</header>

<section class="page-content inner">
<div class="container content">
