<?php if ( post_password_required() ) { return; } ?>
<div id="" class="pt3 center pa3">

<?php if ( have_comments() ) : ?>
  <div class="">
    <h2 class="">Comments:</h2>
  	<?php the_comments_navigation(); ?>
  	<ol class="bg-yellow">
  		<?php
  			wp_list_comments( array(
  				'style'       => 'ol',
  				'short_ping'  => true,
  				'avatar_size' => 32,
  			) );
  		?>
  	</ol>
  </div>
  <div class="">
    <?php the_comments_navigation(); ?>
  </div>

<?php endif; ?>
<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class=""><?php _e( 'Comments are closed.', 'twentysixteen' ); ?></p>
<?php endif; ?>
<div class="w-70 center bg-green tc">
  <?php comment_form( array( 'title_reply_before' => '<h2 id="" class="">', 'title_reply_after'  => '</h2>', ) ); ?>
</div>


</div>
