<div class="w-100 pt4 tc" style="clear: both;">
  <div class="pa3 tc">
    <h2><?php the_field( 'cta_title_label' ); ?></h2>
    <p class="pt3"><?php the_field( 'cta_main_text' ); ?></p>
    <div class="pt4 pb5">
      <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Contact' ) ) ); ?>" class="bg-neonblue ph4 pv3 w-40 white link ">Lets talk</a>
    </div>
  </div>
</div>
