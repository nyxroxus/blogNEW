<div class="w-100" style="">
  <div class="w-40-l tc fl-l">
    <img class="" src="<?php the_field( 'about_image' ); ?>" alt="">
  </div>
  <div class="w-60-l fr-l">
    <div class="w-100 pa3-l pa4">
      <h2 class="f2 pt6-l"><?php the_title(); ?></h2>
      <?php while ( have_posts() ) : the_post(); ?>
      <p class="f1 pt2 lh-copy pb4-l"> <?php the_content(); ?> </p>
      <?php endwhile; wp_reset_query(); ?>
      <div class="pt4">
        <img src="<?php the_field( 'signature_image' ) ?>" alt="">
      </div>
    </div>
  </div>
</div>
