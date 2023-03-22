<div class="item">
  <div class="col thumb">
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>
    <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
  </div>
  <div class="col data">
    <h2><?php the_title(); ?></h2>
    <p><?php echo do_shortcode( '[acf field="bajada_producto"]' ); ?></p>
    <a class="button" href="<?php the_permalink(); ?>">Comprar</a>
  </div>  
</div>