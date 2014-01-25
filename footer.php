</div><!-- /.container -->
</section><!-- /.content -->

<footer class="pageFooter">
  <div class="container wrapper inner">
    <div class="about row">
      <div class="about_me col4">
      <?php if( is_tw_name() != "") : ?>
        <div class="icon"><?php twitter_icon( get_tw_name() ); ?></div>
      <?php endif; ?>
        <div class="my_info">
           <h2 class="name"><?php twitter_name( get_tw_name() ); ?></h2>
          <p class="summary">Web屋さんやってます。<br />Webに関するお仕事ならサーバ構築からサイト運用まで、何でもできますよ。</p>
        </div>
        <div class="skill">
           <h2>大体この辺が守備範囲です</h2>
           <p>サーバ構築 Photoshop Illustrator HTML CSS PHP WordPress</p>
        </div>
      </div>

      <div class="using_social col4">
        <h2>大体このあたりにいます</h2>
  <?php if( is_tw_name() ) : ?>
        <div class="twitter"><a href="http://twitter.com/#!/<?php tw_name(); ?>" target="_blank">@<?php tw_name(); ?></a></div>
  <?php endif; ?>
  <?php if( is_fb_name() ) : ?>
        <div class="facebook"><a href="http://www.facebook.com/<?php fb_name(); ?>" target="_blank"><?php fb_name(); ?></a></div>
  <?php endif; ?>
  <?php if( is_deli_name() ) : ?>
        <div class="delicious"><a href="http://delicious.com/<?php deli_name(); ?>" target="_blank"><?php deli_name(); ?></a></div>
  <?php endif; ?>
      </div><!-- /.using_social -->

      <div class="contact col4">
        <h2>こんなのやってます</h2>
        <ul>
        <li><a href="http://jacket.anticyb.org/" target="_blank">ジャケ買い</a></li>
        <li><a href="http://labs.anticyb.org/" target="_blank">Web制作ラボ</a></li>
        <li><a href="http://bouldering.anticyb.org/" target="_blank">ボルダリングコム</a></li>
        <li><a href="http://movie.anticyb.org/" target="_blank">動画ってほんとうにいいもんですね</a></li>
        </ul>
      </div><!-- /.contact -->
    </div><!-- /.about -->
  </div><!-- /.container -->

  <p class="copyright">copyright@STACKSTOCK</p>
</footer>

<?php /*FBのボタン用JS*/ ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=302143453164759";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php /* FBのボタン用JS */ ?>

<?php /* Googleのボタン用JS */ ?>
<script type="text/javascript">
  window.___gcfg = {lang: 'ja'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<?php /* Googleのボタン用JS */ ?>

<?php wp_footer(); ?>
</body>
</html>
