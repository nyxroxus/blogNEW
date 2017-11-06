<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo get_bloginfo( 'name' ) ?></title>
    <!-- Notice this -->
      <?php  wp_head(); ?>
  </head>
<body>
<div class="bb b--redpink w-100 center">
    <div class="w-100 center">
      <?php the_custom_logo(); ?>
    </div>
    <div class="center tc" style="">
      <?php if ( get_header_image() ): ?>
        <div id="site-header" class="dn dib-l">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php header_image(); ?>"
            width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>"
            alt="">
            <div class="custom-header-text dn dib-l">
              <p class="grow f1"><?php echo get_bloginfo('name'); ?></p>
              <p class="grow f3"><?php echo get_bloginfo('description'); ?></p>
            </div>
          </a>
        </div>
      <?php endif; ?>
      <!-- Used before: <a class="" href="#"> wp_list_pages( '&title_li=' ); </a> -->
      <h1 class="f5-l f5 f4-m custom-header-navigation"><?php wp_nav_menu( array( 'theme_location'  => 'primary', 'container_class' => 'primary_menu' ) ); ?></h1>
    </div>
</div>
