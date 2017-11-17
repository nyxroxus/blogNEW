
<div class="dn">
  <?php get_header();  ?>
</div>


<?php get_template_part('navigation', 'inverted') ?>


<?php
// Set the Current Author Variable $curauth
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<div class="mt3" style="">

  <div class="tc">
      <div class="">
      <?php
      /*
      $image = get_field('image_id');
      $size = 'full';
      echo wp_get_attachment_image( $image, $size );
      */
      ?>
      <?php echo get_avatar( $curauth->user_email , '90 '); ?>
      </div>
      <p><strong>Website:</strong> <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br />
      <strong>Bio:</strong> <?php echo $curauth->user_description; ?></p>
  </div>



  <div class="">
     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
       <div class="center w-90">


       <div class="fl ml4 w-30">


       <div class="default-author-top-color ph4 br-pill" style="overflow:auto;">

            <h3 class="dib fl" style=""><!-- Add color --><a class="link default-color-anchor" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
           <?php the_title(); ?></a></h3>

            <p class="dib fr default-color-anchor" style="padding-top: 5px;"><?php the_time('d M Y'); ?></p>
       </div>

  <!-- Float right add display inline -->

        <div class="pb3 ph4 center tj" style="clear:both;">
          <?php the_excerpt(); ?>
        </div>
      </div>
</div>
    <?php endwhile;

    // Previous/next page navigation.
    the_posts_pagination();


    else: ?>
    <p><?php _e('No posts by this author.'); ?></p>
  </div>

  <?php endif; ?>
</div>

<?php get_footer(); ?>
