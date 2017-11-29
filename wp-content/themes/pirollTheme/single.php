<?php get_template_part( 'partials/Header/head' ); ?>
<div class="w-90-l" style="margin: auto!important;">
  <?php get_template_part('partials/Navigation/navigation', 'main') ?>
</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
  if ( has_post_thumbnail() ) {
    get_template_part('partials/SinglePost/single', 'content');
    get_template_part('partials/SinglePost/single', 'pagination');
  }
  else {
    get_template_part('partials/SinglePost/single', 'no-image');
  }


endwhile;
endif;
?>
<div class="" style="clear: both;">
  <?php get_footer(); ?>
</div>
