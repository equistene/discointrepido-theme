<div class="item-product">
  <a href="<?php the_permalink(); ?>">
    <div class="thumb">
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>
      <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>" loading="lazy">
    </div>
    <div class="info">      
      <?php $albumTitle = get_field('nombre_disco'); ?>
      <?php if($albumTitle): ?>
				<h2><?php echo $albumTitle; ?></h2>			
			<?php else: ?>
				<h2><?php the_title(); ?></h2>			
			<?php endif; ?>			
      <h3><?php $artista_clean = get_the_term_list( $post->ID, 'Artista' ); $artista_clean = strip_tags( $artista_clean ); echo $artista_clean; ?></h3>
      <p><?php echo do_shortcode( '[acf field="bajada_producto"]' ); ?></p>
    </div>
  </a>
</div>