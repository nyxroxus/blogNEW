<article class="clear w-100 fl-l w-30-l bg-white ph3 mr3 mt3 mb3 ml3 pv3 shadow-4" id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?> >
<?php if ( has_post_thumbnail('') ) : ?>
    <div class="">
        <a class="" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
    </div>
<?php endif; ?>
    <div class="" style="">
        <a class="darkpurple f4 link" href="<?php the_permalink() ?>">
          <span class="center"><?php the_title(); ?></span></a>
          <div class=" f6" style="">
            <div class="clear white">
              <div class="dib lightred fl pt2">
                <?php the_date(); ?>
              </div>
              <a href="#" class="dib link white fr"><div class="bg-lightred dib pa1 br4 ph3">
                <?php the_author(); ?>
              </div></a>
            </div>
          </div>

        <div class="clear darkpurple tj pt3 f6 mt2" style="">
            <?php the_excerpt(); ?>
        </div>

    </div>
</article>
