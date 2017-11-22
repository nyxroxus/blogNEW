<div class="dib" style="">
  <?php if ( has_post_thumbnail('') ) : ?>
  <article style="clear:both;" class="" id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?> >
    <a href="<?php the_permalink() ?>" class="">
        <div class="pointer">
          <?php the_post_thumbnail('wordpress-thumbnail'); ?>
        </div>
    </a>
  </article>
  <?php endif; ?>
</div>
