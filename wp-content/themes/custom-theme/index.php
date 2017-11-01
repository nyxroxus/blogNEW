<?php get_header(); ?>

<div class="w-100" style="">
    <div class="w-60 pl5 fl-l">
      <?php if ( have_posts() ) : ?>
<div id="masonry-loop">
  <?php /* The loop */ ?>
  <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content', 'masonry' ); ?>
  <?php endwhile; ?>
</div>

<?php else : ?>
  <?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
    </div>
    <div class="w-30 fr-l pr5">
      <?php get_sidebar(); ?>
    </div>
</div>
<div class="w-100" style="clear: both;">
  <?php get_footer(); ?>
</div>
