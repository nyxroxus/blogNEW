<?php get_header(); ?>

<div class="w-100" style="padding-top: 10%;">
    <div class="w-60 pl5 fl-l">
        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
            get_template_part( 'content', get_post_format() );
        endwhile; endif;
        ?>
    </div><!-- /.blog-main -->
    <div class="w-30 fr-l pr5">
      <?php get_sidebar(); ?>
    </div>
</div>
<div class="w-100" style="clear: both;">
  <?php get_footer(); ?>
</div><!-- /.row -->
