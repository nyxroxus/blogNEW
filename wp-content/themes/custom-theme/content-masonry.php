<article style="" class="w-100 fl-l w-30-l mr3 mt3 mb3 ml3 pb3 shadow-4" id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?> >
  <div class="center tc default-color-heading-box">

    <h3 class="ph3 pv2 default-color-heading"><?php the_title(); ?></h3>
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

        <div class="mt2 dib mr2 pa1 br4 ph3 fr default-color-author">
          <a href="#"><?php comments_number( 'no comments', '1 comment', '2+' ); ?></a>
        </div>
      </div>
    </div>

    <div class="clear lh-copy tj pt4 f6 " style="">
      <p class=""><?php the_excerpt(); ?></p>
    </div>

  </div>
</article>
