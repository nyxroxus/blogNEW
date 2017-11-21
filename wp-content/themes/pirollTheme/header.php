<?php wp_head(); ?>
<?php get_template_part('navigation', 'main') ?>
<div class="center tc">
  <?php if ( get_header_image() ): ?>
    <div id="site-header" class="dn dib-l">
        <div class="" style="background-color: #000000;">
          <img src="<?php header_image(); ?>" style="opacity: 0.5; filter:blur(2px);"
          width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>"
          alt="">
        </div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="tc dn dib-l ph5 br2 custom-header-text">
          <p class="grow f2 white"><?php echo get_bloginfo('name'); ?></p>
          <p class="grow f4 pt2 white"><?php echo get_bloginfo('description'); ?></p>
        </div>
        </a>
    </div>
  <?php endif; ?>
</div>
