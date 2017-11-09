<?php get_header(); ?>
<div class="w-100" style="">
  <div class="w-70 pl5 fl-l mt4 mb4">
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
    else{ get_template_part( 'content', 'none' ); }
?>

<?php endwhile; wp_reset_postdata(); ?>

  </div>
  <div class="w-30 fr-l ph5 mt4">
    <?php get_sidebar(); ?>
  </div>
</div>
<div class="w-100" style="clear: both;">
  <?php get_footer(); ?>
</div>
