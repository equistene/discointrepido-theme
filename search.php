<?php get_header(); ?>

	<main role="main" class="container archive-content">	
		
		<h1 class="titlePage"><?php echo sprintf( __( '%s resultados para: ', 'html5blank' ), $wp_query->found_posts ); ?> <span><?php echo get_search_query(); ?></span></h1>

		<div class="row">
			<section>			
				<?php get_template_part('loop'); ?>
				<?php get_template_part('pagination'); ?>
			</section>		

			<aside>
				<?php get_template_part('partials/sidebar/filters') ?>
			</aside>
		</div>

	</main>

<?php get_footer(); ?>
