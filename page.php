<?php get_header(); ?>

  <section class="main col8">
<?php while (have_posts()) : the_post(); ?>
    <article>
      <header>
        <h1 class="post_title"><?php the_title(); ?></h1>
        <p class="publish_date"><?php the_time('Y年m月d日') ?></p>
      </header>

      <div class="post_content">
        <?php the_content(''); ?>
      </div>
    </article>
<?php endwhile; ?>
  </section>

<?php get_sidebar();?>

<?php get_footer(); ?>
