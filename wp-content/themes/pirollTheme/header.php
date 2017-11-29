<?php get_template_part( 'partials/Header/head' ); ?>
<div>
  <div class="w-90-l" style="margin: auto!important;">
    <?php get_template_part('partials/Navigation/navigation', 'main') ?>
  </div>
  <?php if ( get_header_image() ):
    get_template_part( 'partials/Header/header', 'image' );
  endif; ?>
</div>
