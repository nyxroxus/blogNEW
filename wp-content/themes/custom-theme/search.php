<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
<?php if (is_page()) continue; ?>
<?php endwhile; ?>
<?php endif; ?>
