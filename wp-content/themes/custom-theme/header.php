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
<div class="w-70 center mt3">
    <div class="w-100 center">
      <?php the_custom_logo(); ?>
    </div>
    <div class="bt bb b--redpink center tc" style="">
      <!-- Used before: <a class="" href="#"> wp_list_pages( '&title_li=' ); </a> -->
        <h1 class="f5-l f5 header-navigation"><?php wp_nav_menu( array( 'theme_location'  => 'primary', 'container_class' => 'primary_menu' ) ); ?></h1>
    </div>
</div>
