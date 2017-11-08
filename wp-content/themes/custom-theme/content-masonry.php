<article class="clear w-100 fl-l w-30-l ph3 mr3 mt3 mb3 ml3 pv3 shadow-4" id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?> >
<?php if ( has_post_thumbnail('') ) : ?>
    <div class="">
        <a class="" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
    </div>
<?php endif; ?>
  <div class="" style="">
    <h3 class="center"><?php the_title(); ?></h3>
    <div class=" f6" style="">
      <div class="clear">
        <div class="dib fl pt2">
          <?php the_date(); ?>
        </div>

          <div class="dib pa1 br4 ph3 fr">
            <?php the_author_posts_link(); ?>
          </div>
      </div>
    </div>

    <div class="clear lh-copy tj pt4 f6 " style="">
      <p class=""><?php the_excerpt(); ?></p>
    </div>

  </div>
</article>
