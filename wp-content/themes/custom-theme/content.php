<div class="">
	<h2 class="pointer">
		<a class=""
			href="<?php the_permalink() ?>"><?php the_title(); ?>
		</a>
	</h2>
	<p class=""><?php the_date(); ?> </p> by 
		<a href="#" class="">
			<?php the_author(); ?>
		</a>

    <?php the_excerpt(); ?>
</div>
