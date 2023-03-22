<?php get_header(); ?>

	<main role="main" class="page container">
		<!-- section -->
		<section>

		<h1 class="titlePage"><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<article class="shop-body">

				<div class="content-shop">
					<?php the_content(); ?>
				</div>


				<div class="aside-filters">
					<?php get_template_part('partials/sidebar/filters') ?>
				</div>
				

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>