<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die ('このページには直接アクセスできません。');
if ( post_password_required() ) {
  echo '<p class="nocomments">この投稿はパスワードで保護されています。コメントを閲覧するにはパスワードを入力してください。<p>';
  return;
}
?>

<section class="commment_list">
<?php if ( have_comments() ) : ?>
  <?php if (  empty($comments_by_type['comment']) ) : ?>
  <h3 id="Comments"><?php comments_number('comment', 'コメント1つ', '%個のコメント' );?></h3>
  <ol>
   <?php wp_list_comments('type=comment'); ?>
  </ol>
  <?php else: ?>
  <p>コメントはありません。</p>
  <?php endif; ?>

  <?php if ( ! empty($comments_by_type['pings']) ) : ?>
  <h3 id="Trackbacks">Trackbacks/Pinbacks</h3>
  <ol>
  <?php wp_list_comments('type=trackback'); ?>
  </ol>
  <?php else: ?>
  <p>トラックバック/ピンバックはありません。</p>
  <?php endif; ?>
  <?php if (previous_comments_link() || next_comments_link() ) : ?>
  <ul class="navigation">
  <li class="previous-comments"><?php previous_comments_link() ?></li>
  <li class="next-comments"><?php next_comments_link() ?></li>
  </ul>
  <?php endif; ?>
<?php else : // this is displayed if there are no comments so far ?>
  <?php if ( comments_open() ): ?>
  <?php else: ?>
  <p class="nocomments">この記事はコメント、トラックバックおよびピンバックを受け付けていません。</p>
  <?php endif; ?>
<?php endif; ?>
</section>

<?php /*
<?php if ('open' == $post->comment_status) : ?>
<?php if ( $user_ID ) : ?>
<div id="respond" class="login">
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <input type="hidden" value="<?php echo $id; ?>" />
   	<?php comment_id_fields(); ?>

    <section class="info">
    <p><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>でコメント</p>
    </section>

    <section class="content">
      <label for="comment">コメント</label>
      <textarea name="comment" id="comment" tabindex="4"></textarea>
      <p><input name="submit" type="submit" id="submit" tabindex="5" value="記入" /></p>

    <div id="cancel-comment-reply">
     <p><?php cancel_comment_reply_link() ?></p>
   </div>
   <?php do_action('comment_form', $post->ID); ?>
   </section>
<?php else : ?>
<div id="respond" class="logout">
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <input type="hidden" value="<?php echo $id; ?>" />
   	<?php comment_id_fields(); ?>

    <section class="info">
      <label for="author">名前 <span><?php if ($req) _e('(required)'); ?></span></label>
      <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
      <label for="email">メール<span><?php if ($req) _e('(required)'); ?></span></label>
      <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
      <label for="url">Webサイト</label>
      <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
  </section>

  <section class="content">
    <label for="comment">コメント</label>
    <textarea name="comment" id="comment" tabindex="4"></textarea>
    <p><input name="submit" type="submit" id="submit" tabindex="5" value="記入" /></p>

    <div id="cancel-comment-reply">
     <p><?php cancel_comment_reply_link() ?></p>
   </div>
   <?php do_action('comment_form', $post->ID); ?>
  </section>
<?php endif; // Check for $user_ID ?>
  </form>
</div>
<?php endif; ?>
*/ ?>
