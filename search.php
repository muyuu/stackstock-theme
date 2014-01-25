<?php get_header(); ?>

  <section class="main col8">
    <article>
      <h1 class="archive-title"><strong><?php print("「".$_GET['s']."」"); ?>の検索結果</strong></h1>
<?php while (have_posts()) : the_post(); ?>
      <h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php endwhile; ?>
      <nav class="pagenavi">
<?php posts_nav_link(); ?>
      </nav>
    </article>
  </section>

<?php get_sidebar();?>

<?php get_footer(); ?>
