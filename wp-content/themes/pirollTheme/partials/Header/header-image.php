<div id="site-header" class="dib-l">
    <div class="dn db-l" style="background-color: #000000; opacity: 0.9; filter:blur(1px);">
      <img src="<?php header_image(); ?>" style=""
      width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>"
      alt="">
    </div>
    <div class="dn-l" style="background-color: #000000; opacity: 0.9; filter:blur(1px);">
      <img src="<?php the_field( 'header_image_small' ) ?>" style=""
      width="340px" height="350px"
      alt="">
    </div>
    <?php get_template_part( 'partials/Header/bloginfo' ) ?>
</div>
