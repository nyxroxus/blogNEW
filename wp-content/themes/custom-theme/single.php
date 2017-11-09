<?php get_header(); ?>
<article class="clear w-100 center pt3">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="tc f2">
    <?php the_title(); ?>
  </div>
  <div class="pa2 default" style="overflow: auto;">
    <div class="w-90 center">
      <div class="dib fl pa2 br4 default-clean-color">
        <div class="default-clean-link-color">
          <?php the_author_posts_link(); ?>
        </div>
      </div>
      <div class="dib fr pa2 br4 default-clean-color">
        <div class="default-clean-color">
          <?php echo get_the_date(); ?>
        </div>
      </div>
      <div class="dib pa2 br4 default-clean-color ml3">
        <div class="default-clean-color">
          <?php comments_number( 'There are no comments on this post', '1 comment', '2+ comments' ); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="w-80 center">
    <?php the_content(); ?>
  </div>
  <div class="w-100 center">
    <div class="tc">
      <input type='button' style="border: none!important;" class="pa3 w-100 default-button-color" id='hideshow' value='View comments'>
    </div>


    <div id='comments' class="center w-90 bg-red mt3">
      <?php
      if ( comments_open() || get_comments_number() ) {
        comments_template();
      }
      ?>
    </div>
  </div>
 <?php endwhile; ?>
 <?php endif; ?>
</article>

<div class="" style="clear: both; margin-top: 50px;">
  <?php get_footer(); ?>
</div>

<!-- Script that has to go somewhere else  -->
<script>
jQuery(document).ready(function(){
    jQuery('#hideshow').live('click', function(event) {
         jQuery('#comments').toggle('show');
    });
});
</script>
