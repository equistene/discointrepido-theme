<section class="related-products">
  <div class="titleSection">Otros productos que te pueden interesar</div>

  <div class="itemsList">  
    <?php
      $args = array(     
        'post_type' => 'product',
        'posts_per_page' => 4,
        'orderby' => 'rand'
      );           
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
        get_template_part('partials/item-product-card');
      endwhile; endif; wp_reset_postdata();
    ?>
  </div>
</section>