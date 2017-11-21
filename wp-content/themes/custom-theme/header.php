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
          <div class="bg-black">
            
            </div>
            </a>
          </div>

        </div>
      <?php endif; ?>
      <!-- Used before: <a class="" href="#"> wp_list_pages( '&title_li=' ); </a> -->
      <?php get_template_part('navigation') ?>
      <?php if( get_field('image_id') ): ?>
  	     <img src="<?php the_field('image_id'); ?>" />.
      <?php endif; ?>
    </div>
</div>
