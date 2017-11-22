<?php get_header() ?>

<div class="tc pt2">
  <?php
    global $post;
    $page_id = $post->ID;
    $the_query = new WP_Query( 'posts_per_page=10' );
  ?>
    <?php while ($the_query -> have_posts()) :
      $the_query -> the_post();
      get_template_part( 'content', 'main' );
  ?>
  <?php endwhile; wp_reset_postdata(); ?>
</div>

<?php get_footer() ?>
