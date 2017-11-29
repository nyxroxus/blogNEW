<?php get_header() ?>

<div class="tc pt2-l">
  <?php
    global $post;
    $page_id = $post->ID;
    $check_man = get_post_meta($page_id,'post_template', true);
    $post_template = get_field('post_layout');
    $the_query = new WP_Query( 'posts_per_page=10' );
  ?>
    <?php while ($the_query -> have_posts()) :
      $the_query -> the_post();
      if ($post_template == 'one') {
        get_template_part('content', 'main');
      }
      elseif ($post_template == 'two') {
        get_template_part('content', 'masonry');
      }
      elseif ($post_template == 'three') {
        get_template_part('content', 'list');
      }
      elseif ($post_template == 'four') {
        get_template_part('content', '2-column');
      }
      else{
        get_template_part('content', 'video');
      }
    endwhile; wp_reset_postdata(); ?>
</div>

<?php get_footer() ?>
