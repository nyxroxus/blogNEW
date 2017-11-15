<article class="mt3 w-70 mb3 shadow-4 fl">
	<div class="default-color-heading-box">
		<h2 class="ph3 pv2 default-color-heading"><?php the_title(); ?></h2>
	</div>
	<div class="f7 w-100 ph2">
		<div class="fl dib pv1 w-20 tc br4 default-color-author">
			<?php the_author_posts_link(); ?>
		</div>
		<div class="f6 dib fr tc w-20 default-color-date">
			<?php the_date(); ?>
		</div>
	</div>
	<div class="f5 mt5 lh-copy ph3">
		<p class="" style=""><?php the_excerpt(); ?></p>
	</div>
</article>

<div class="w-30 fr">
	<?php get_sidebar(); ?>
</div>
