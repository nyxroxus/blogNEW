<?php
  if( is_page('about') ){
    get_template_part( 'partials/AboutPage/page', 'about' );
  }
  elseif( is_page( 'contact-us' ) ){
    get_template_part( 'partials/ContactPage/page', 'contact' );
  }
  elseif( is_page( 'legals' ) ){
    get_template_part( 'partials/Header/head' );
    get_template_part( 'partials/Navigation/navigation', 'main' );
    ?>
    <div class="">
      <?php while ( have_posts() ) : the_post(); ?>
      <p class=""> <?php the_content(); ?> </p>
      <?php endwhile; wp_reset_query(); ?>
    </div>
    <?php 
  }
  else{
    ?>
    <div class="">
      <?php get_template_part( 'header' ); ?>
        <div class="">
          <?php while ( have_posts() ) : the_post(); ?>
          <p class=""> <?php the_content(); ?> </p>
          <?php endwhile; wp_reset_query(); ?>
        </div>
      <?php get_template_part( 'footer' ); ?>
    </div>
    <?php
  }
?>
