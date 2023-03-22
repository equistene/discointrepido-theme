<?php get_header(); ?>

	<main role="main" class="container">
		<!-- section -->
		<section>

			<h1><?php single_cat_title(); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
