<?php get_header(); ?>

  <section class="main col8">
<?php while (have_posts()) : the_post(); ?>
    <article>
      <header>
        <h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="publish_date"><?php the_time('Y年m月d日') ?></p>
      </header>
      <div class="post_content">
        <div class="thumbnail">
<?php if ( has_post_thumbnail() ) {
         the_post_thumbnail();
      } else { ?>
         <img src="<?php bloginfo('template_url'); ?>/i/default_thumb.jpg" />
<?php  } ?>
        </div>

        <?php the_excerpt(''); ?>
        <p class="excerpt"><i class="fa-book"></i><a href="<?php the_permalink(); ?>">つづきをよむ</a></p>
      </div>
    </article>
<?php endwhile; ?>

    <nav class="pagenavi">
      <?php next_posts_link('一つ前のページ'); ?>
      <?php previous_posts_link('一つ新しいページ'); ?>
    </nav>
  </section>

<?php get_sidebar();?>

<?php get_footer(); ?>
