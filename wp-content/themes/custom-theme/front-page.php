<?php get_header(); ?>
<div class="w-100">
  <div class="w-90 center" style="">
  <?php
    global $post;
    $page_id = $post->ID;
    $check_man = get_post_meta($page_id,'post_template', true);
    $the_query = new WP_Query( 'posts_per_page=6' );
  ?>
    <?php while ($the_query -> have_posts()) :
      $the_query -> the_post();
      if($check_man == '1' ){ get_template_part( 'content', 'masonry' ); }
      else if($check_man == '2'){ get_template_part( 'content', 'list' ); }
      else if($check_man == '3'){ get_template_part( 'content', 'test' ); }
      else{ get_template_part( 'content', 'none' ); }

      if($check_man == '1' ){ get_template_part( 'content', 'main' ); }
      else if($check_man == '2'){ get_template_part( 'content', 'list' ); }
      else if($check_man == '3'){ get_template_part( 'content', 'masonry' ); }
      else{ get_template_part( 'content', '2-column' ); }
  ?>
  <?php endwhile; wp_reset_postdata(); ?>
  </div>
</div>


<div class="w-100" style="clear: both;">
  <?php get_footer(); ?>
</div>
