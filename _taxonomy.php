<?php get_header(); ?>

	<main role="main" class="container archive-content">	

		<?php $taxonomy = get_queried_object(); ?>	
		
		<h1><?php echo $taxonomy->taxonomy; ?>: <span><?php single_term_title(); ?><span></h1>

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
