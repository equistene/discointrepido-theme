<?php get_header(); ?>

	<main role="main" class="artistas-archive">
		<!-- section -->
		<section>

			<h1>Artistas</h1>

			<?php get_template_part('loop-artistas'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>