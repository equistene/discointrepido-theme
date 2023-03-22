<?php get_header(); ?>

	<main role="main" class="page single-blog container">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<h4 class="blog-title">Blog</h4>
			<h1 class="titlePage text-center"><?php the_title(); ?></h1>
			<div class="date"><?php the_time('d - F - Y') ?></div>

			
			<!--
			<?php if(has_post_thumbnail()): ?>
				<div class="post-thumbnail-intro">
					<?php the_post_thumbnail('large'); ?>
				</div>
			<?php endif; ?>
			-->

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
