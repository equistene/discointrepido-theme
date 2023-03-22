<?php /* Template Name: Page Simple */ get_header(); ?>

	<main role="main" class="page container">
		<!-- section -->
		<section>

		<h1 class="titlePage text-center"><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<article class="page-body">

				<div class="content-shop">
					<?php the_content(); ?>
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

<?php get_footer(); ?>
