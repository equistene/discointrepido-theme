<div class="itemsList cols-3">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<?php get_template_part('partials/item-post') ?>
	<?php endwhile; else: ?>
		<!-- article -->
		<article>
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
		</article>
		<!-- /article -->
	<?php endif; ?>
</div>