<?php get_header(); ?>
<article class="clear w-80 center pt3">
<?php if (have_posts()) : while (have_posts()) : the_post();
if ( comments_open() || get_comments_number() ) {
  comments_template();
}
?>

  <div class="tc f2">
    <?php the_title(); ?>
  </div>
  <div class="">
    <?php the_content(); ?>
  </div>



 <?php endwhile; ?>
 <?php endif; ?>
</article>
<div class="pa2" style="overflow: auto;">
  <div class="w-80 center">
    <div class="dib fl pa2 br4">
      <?php the_author_posts_link(); ?>
    </div>

    <div class="dib fr pa2 br4">
      <?php echo get_the_date(); ?>
    </div>
  </div>
</div>
<!-- Import comments and display them when the user click on a button 'show comments' -->
<div class="" style="clear: both; margin-top: 50px;">
  <?php get_footer(); ?>
</div>
