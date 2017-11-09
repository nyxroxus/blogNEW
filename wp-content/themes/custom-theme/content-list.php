<div class="pa3 mt3 bg-white w-70 mb3 shadow-4 fl">
	<h2 class="pointer">
    <a class="lightred link" href="<?php the_permalink() ?>">
      <?php the_title(); ?>
    </a>
  </h2>
		<div class="f7 w-100">
			<div class="fl dib mt3 pv1 w-20 tc br4 white bg-lightred">
				<?php the_author() ?>
			</div>
			<div class="dib fr tc w-20 lightred">
				<?php the_date(); ?>
			</div>

		</div>

		<div class="f6 pt4">
			<?php the_excerpt(); ?>
		</div>
</div>
<div class="w-30 fr">
	<?php get_sidebar(); ?>
</div>
