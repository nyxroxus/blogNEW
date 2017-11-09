<article class="clear w-100 fl-l w-30-l mr3 mt3 mb3 ml3 pv3 shadow-4" id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?> >
<?php if ( has_post_thumbnail('') ) : ?>
    <div class="">
        <a class="" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
    </div>
<?php endif; ?>

  <div class="default-color-heading-box ph2 pv2">
    <h3 class="center default-color-heading"><?php the_title(); ?></h3>
  </div>
  <div class="ph3" style="">
    <div class="f7" style="">
      <div class="clear">
        <div class="dib fl mt2 pt1 default-color-date">
          <?php the_date(); ?>
        </div>

        <div class="mt2 dib pa1 br4 ph3 fr default-color-author">
          <?php the_author_posts_link(); ?>
        </div>
      </div>
    </div>

    <div class="clear lh-copy tj pt4 f6 " style="">
      <p class=""><?php the_excerpt(); ?></p>
    </div>

  </div>
</article>
