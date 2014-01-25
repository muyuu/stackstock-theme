<?php get_header(); ?>

<div class="content">
  <section class="main col8">
<?php /* If this is a category archive */ if (is_category()) { ?>
    <h1 class="archive-title">&#8216;<strong><?php single_cat_title(); ?></strong>&#8217;に関するページ</h1>
<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    <h1 class="archive-title">&#8216;<strong><?php single_tag_title(); ?></strong>&#8217;に関するページ</h1>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    <h1 class="archive-title"><strong><?php the_time('Y年m月d日'); ?></strong>に書いたページ</h1>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    <h1 class="archive-title"><strong><?php the_time('Y年m月'); ?></strong>に書いたページ</h1>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <h1 class="archive-title"><strong><?php the_time('Y年'); ?></strong>に書いたページ</h1>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
    <h1 class="archive-title">Author Archive</h1>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <h1 class="archive-title">Blog Archives</h1>
<?php } ?>

    <section class="archive-list">
<?php while (have_posts()) : the_post(); ?>
    <h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php endwhile; ?>
    </section>

    <nav class="pagenavi">
     <?php posts_nav_link(); ?>
    </nav>
  </section>
  <!-- メインコンテンツ終わり -->

<?php get_sidebar();?>

<?php get_footer(); ?>
