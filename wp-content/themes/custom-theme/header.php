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
<div class="w-100 center">
    <div class="w-100 center">
      <?php the_custom_logo(); ?>
    </div>
    <div class="center tc" style="">
      <?php if ( get_header_image() ): ?>
        <div id="site-header" class="dn dib-l">

            <img src="<?php header_image(); ?>"
            width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>"
            alt="">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="custom-header-text tl dn dib-l default-color-box ph5 br2">
              <p class="grow f2 default-blog-font-color"><?php echo get_bloginfo('name'); ?></p>
              <p class="grow f4 default-blog-font-color"><?php echo get_bloginfo('description'); ?></p>
            </div>
            </a>
        </div>
      <?php endif; ?>
      <!-- Used before: <a class="" href="#"> wp_list_pages( '&title_li=' ); </a> -->
      <?php get_template_part('navigation') ?>
    </div>
</div>
