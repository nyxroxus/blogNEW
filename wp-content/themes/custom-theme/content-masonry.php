<article class="clear w-30 fl custom-color-hover pointer" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
<?php if ( has_post_thumbnail() ) : ?>
    <div class="">
        <a class="white" href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
    </div>
<?php endif; ?>
    <div class="pt3 pa3">
        <a class="white f3 link" href="<?php the_permalink(' ') ?>">
          <span class="center"><?php the_title(); ?></span></a>

        <div class="custom-color tj">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
