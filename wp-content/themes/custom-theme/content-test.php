<?php if ( has_post_thumbnail('') ) : ?>
<article style="clear:both;" class=" w-100 w-80-l center mr3 mt3 mb3 ml3 pb3 shadow-4" id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?> >
  <div class="" style="">
      <div class="">
        <?php the_post_thumbnail('featured-large'); ?>
      </div>
  </div>
</article>
<?php endif; ?>
<?php get_template_part('content', 'masonry'); ?>
