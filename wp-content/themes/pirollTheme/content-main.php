<div class="dib" style="">
  <?php if ( has_post_thumbnail('') ) : ?>
  <article style="clear:both;" class="overlay-image" id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?> >
    <a href="<?php the_permalink() ?>" class="">
      <div class="pointer image">
        <?php the_post_thumbnail('wordpress-thumbnail'); ?>
        <span class="read-more"><i class="fa fa-eye fa-2x white link"></i></span>
      </div>
    </a>
  </article>
  <?php endif; ?>
</div>
