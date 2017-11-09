<div class="">
	<h2 class="pointer">
		<a class="lightred link"
			href="<?php the_permalink() ?>"><?php the_title(); ?>
		</a>
	</h2>
	<p class=""><?php the_date(); ?> by
		<a href="#" class="lightred link">
			<?php the_author(); ?>
		</a>
	</p>
    <?php the_excerpt(); ?>
</div>
