<?php

// ウィジェットを利用する
$args1 = array(
	      'name'          => 'NEWSサイドバー',
	      'id'            => 'sidebar-1',
	      'description'   => '',
	      'before_widget' => '<li id="%1$s" class="widget %2$s">',
	      'after_widget'  => '</li>',
	      'before_title'  => '<h2 class="widgettitle">',
	      'after_title'   => '</h2>' );

$args2 = array(
	      'name'          => '会社概要サイドバー',
	      'id'            => 'sidebar-2',
	      'description'   => '',
	      'before_widget' => '<li id="%1$s" class="widget %2$s">',
	      'after_widget'  => '</li>',
	      'before_title'  => '<h2 class="widgettitle">',
	      'after_title'   => '</h2>' );

if ( function_exists('register_sidebar') ) {
    register_sidebar($args1);
    register_sidebar($args2);
}

// カスタムする場合
if ( USE_WP_WIDGETS_CUSTOM ) {
  // -----------------------------------------------------------------------------
  /**
   * Tag cloud widget class
   *
   * @since 2.8.0
   */
  // -----------------------------------------------------------------------------
  class MY_WP_Widget_Tag_Cloud extends WP_Widget_Tag_Cloud {

    function widget( $args, $instance ) {
      extract($args);
      $current_taxonomy = $this->_get_current_taxonomy($instance);
      if ( !empty($instance['title']) ) {
        $title = $instance['title'];
      } else {
        if ( 'post_tag' == $current_taxonomy ) {
          $title = __('Tags');
        } else {
          $tax = get_taxonomy($current_taxonomy);
          $title = $tax->labels->name;
        }
      }
      $title = apply_filters('widget_title', $title, $instance, $this->id_base);

      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;
      echo '<div class="tagcloud">';
      wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => $current_taxonomy) ) );
      echo "</div>\n";
      echo $after_widget;
    }
  }


  // -----------------------------------------------------------------------------
  /**
   * Categories widget class
   *
   * @since 2.8.0
   */
  // -----------------------------------------------------------------------------
  class MY_WP_Widget_Categories extends WP_Widget_Categories {

    function widget( $args, $instance ) {
      extract( $args );

      $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base);
      $c = ! empty( $instance['count'] ) ? '1' : '0';
      $h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
      $d = ! empty( $instance['dropdown'] ) ? '1' : '0';

      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;

      $cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);

      if ( $d ) {
        $cat_args['show_option_none'] = __('Select Category');
        wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
  ?>

  <script type='text/javascript'>
  /* <![CDATA[ */
    var dropdown = document.getElementById("cat");
    function onCatChange() {
      if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
        location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
      }
    }
    dropdown.onchange = onCatChange;
  /* ]]> */
  </script>

  <?php
      } else {
  ?>
      <ul class="unstyled">
  <?php
      $cat_args['title_li'] = '';
      wp_list_categories(apply_filters('widget_categories_args', $cat_args));
  ?>
      </ul>
  <?php
      }

      echo $after_widget;
    }
  }

  // -----------------------------------------------------------------------------
  // 呼び出し
  // -----------------------------------------------------------------------------
  function my_wp_widget_register() {
      register_widget('My_WP_Widget_Tag_Cloud');
      register_widget('My_WP_Widget_Categories');
  }
  add_action('widgets_init', 'my_wp_widget_register');
}

