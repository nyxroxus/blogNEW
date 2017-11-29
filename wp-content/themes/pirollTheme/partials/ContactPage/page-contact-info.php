<div class="w-50-l ph5-l pv4-l ph3 ph2 fl-l">
  <h2 class="f2 tl-l tc pt3"><?php the_title(); ?> info: </h2>
  <?php while ( have_posts() ) : the_post(); ?>
  <p class="pt4 lh-copy tl-l tc"> <?php the_content(); ?> </p>
  <?php endwhile; wp_reset_query(); ?>
</div>
