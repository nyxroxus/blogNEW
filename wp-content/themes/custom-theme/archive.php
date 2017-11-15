<?php
/*
Template Name: Archives
*/
?>
<div id="" style="clear:both;">
	<div id="" role="">
		<?php the_post(); ?>
		<h1 class=""><?php the_title(); ?></h1>
		<?php get_search_form(); ?>
		<h2>Archives by Month:</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
		<h2>Archives by Subject:</h2>
		<ul>
			 <?php wp_list_categories(); ?>
		</ul>
	</div>
</div>
