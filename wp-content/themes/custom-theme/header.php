<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo get_bloginfo( 'name' ) ?></title>
    <!-- Notice this -->
      <?php  wp_head(); ?>
  </head>
<body>
<div class="w-90 center mt3">
    <div class="w-30-l w-70 fl fl-l" style="padding-top: 2%;">
        <div class="" style="">
            <?php the_custom_logo() ?>
            <!-- Implement header logo -->
        </div>
    </div>

    <div class="w-70-l fr-l dn dib-l" style="">
      <!-- Used before: <a class="" href="#"> wp_list_pages( '&title_li=' ); </a> -->
        <h1 class="f4-l f5 tr-l header-navigation navigation"><?php wp_nav_menu( array( 'theme_location'  => 'primary', 'container_class' => 'primary_menu' ) ); ?></h1>
    </div>
    <div class="w-30 fr mt2 dib dn-l">
        <i class="pointer fa fa-bars fa-3x fr custom-padding-menu"></i>
        <!-- Add navigation menu functionality -->
    </div>
    <!-- <?php if(is_page( 'about-us' )) : ?><h3><?php the_title(); ?></h3><?php endif ?> -->

</div>
