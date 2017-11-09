<article class="pa3 mt3 w-70 mb3 shadow-4 fl">
<h2 class=""><?php the_title(); ?></h2>
	<div class="f7 w-100">
		<div class="fl dib pv1 w-20 tc br4 background-color ">
			<?php the_author_posts_link(); ?>
		</div>
		<div class="f6 dib fr tc w-20 font-color">
			<?php the_date(); ?>
		</div>
	</div>
	<div class="f5 mt5 lh-copy pa2">
		<p class="" style=""><?php the_excerpt(); ?></p>
	</div>
</article>

<div class="w-30 fr">
	<?php get_sidebar('front'); ?>
</div>
