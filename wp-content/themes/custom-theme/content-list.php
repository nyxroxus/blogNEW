<div class="pa3 mt3 bg-white w-70 mb3 shadow-4 fl">
	<h2 class="pointer">
    <a class="lightred link" href="<?php the_permalink() ?>">
      <?php the_title(); ?>
    </a>
  </h2>

		<div class="">
			<?php the_date(); ?>
		</div>
    <a href="#" class="lightred link">
			<div class="">
    	<?php the_author(); ?>
    	</div>
    </a>
		<div class="">
			<?php the_excerpt(); ?>
		</div>
</div>
<div class="w-30 fr">
	<?php get_sidebar(); ?>
</div>
