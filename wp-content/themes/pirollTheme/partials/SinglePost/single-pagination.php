<div class="tc w-100 pa4-l pa3" style="clear: both;">
    <div class="dib tl w-30">
      <?php previous_post_link('<p class="gray"><strong>%link</strong></p>', 'PREVIOUS'); ?>
    </div>
    <div class=" w-30 tc dib">
      <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Home' ) ) ); ?>" class=""><i class="fa fa-th-large fa-lg"></i>
    </div>
    <div class="dib tr w-30">
      <?php next_post_link( '<p class="gray"><strong>%link</strong></p>', 'NEXT' ); ?>
    </div>
</div>
