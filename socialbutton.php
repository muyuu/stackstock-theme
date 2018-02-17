     <section class="social_button">
       <h2>共有とか拡散とかブクマとか</h2>
       <div class="wrap">
         <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="box_count" data-width="70" data-show-faces="true"></div>

         <div class="topsy_widget_data">
           <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php tw_name(); ?>" data-lang="ja" data-count="vertical">ツイート</a>
           <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
         </div>

         <div class="google_button">
           <g:plusone size="tall" href="<?php the_permalink(); ?>"></g:plusone>
         </div>

         <div class="hatena_button">
           <a href="https://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php the_title(); ?>" data-hatena-bookmark-layout="vertical" title="このエントリーをはてなブックマークに追加">
             <img src="https://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" />
           </a>
           <script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
         </div>
       </div>
     </section>
