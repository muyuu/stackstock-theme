<?php get_header(); ?>

  <section class="main col8">
<?php while (have_posts()) : the_post(); ?>
    <article>
      <header>
        <h1 class="post_title"><?php the_title(); ?></h1>
        <p class="publish_date"><?php the_time('Y年m月d日') ?></p>
      </header>

      <div class="bnrArea">
        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-5004750064695656";
        /* SS 個別ページ上部 */
        google_ad_slot = "5684883028";
        google_ad_width = 300;
        google_ad_height = 250;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
        <?php if ( has_post_thumbnail() ) {
              echo '<div class="thumbnail">';
                the_post_thumbnail();
              echo '</div>';
            }
        ?>
      </div>

      <div class="post_content">
        <?php the_content(''); ?>
      </div>

      <?php get_template_part('socialbutton'); ?>

<?php //関連記事一覧
    $original_post = $post;
    $tags = wp_get_post_tags($post->ID);
    $tagIDs = array();
    if ($tags) {
        $tagcount = count($tags);
        for ($i = 0; $i < $tagcount; $i++) {
            $tagIDs[$i] = $tags[$i]->term_id;
        }
    $args=array(
    'tag__in' => $tagIDs,
    'post__not_in' => array($post->ID),
    'showposts'=>10,
    'caller_get_posts'=>1
    );
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {?>
      <section class="recommend">
        <h2>他にこんな事も書いてます</h2>
        <ul>
<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
          <li><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; wp_reset_query(); ?>
        </ul>
      </section>
<?php } } ?>

      <section class="bt-links">
        <h2>この記事の分類</h2>
        <p>
          <strong>種類:</strong> <?php the_category(', ') ?><br />
          <?php the_tags('<strong>ジャンル:</strong> ',' '); ?>
        </p>
      </section>

      <nav class="pagenavi">
        <?php next_post_link('%link', 'これの次に書いたページ'); ?>
        <?php previous_post_link('%link', 'これの前に書いたページ'); ?>
      </nav>

      <section class="comment">
        <h2>FBでコメント</h2>
        <p class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="2" data-width="480"></p>
        <?php comments_template();  ?>
      </section>
    </article>
<?php endwhile; ?>
  <!-- </section> -->

<?php get_sidebar();?>

<?php get_footer(); ?>
