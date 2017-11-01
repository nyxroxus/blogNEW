<article class="clear w-30 fl mr3 bg-darkpurple hover-bg-redpink mb3 mt2" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
<?php if ( has_post_thumbnail() ) : ?>
    <div class="">
        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
    </div>
<?php endif; ?>
    <div class="">
        <h5 class=""><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><span class=""> <?php the_title(); ?></span></a></h5>
        <div class="pa3">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
