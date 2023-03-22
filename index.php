<?php get_header(); ?>

  <main class="home">
  
    <section class="featured-slider">
      <div class="container">
        <div class="slider-home js-slider-home">
        <?php
          $args = array(     
            'post_type' => 'product',
            'posts_per_page' => 3,
            'orderby' => 'rand',
          );           
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            get_template_part('partials/item-slider');
          endwhile; endif; wp_reset_postdata();
        ?>        
        </div>
      </div>
    </section>

    <?php if( have_rows('featured_boxes_home', 'option') ): ?>
    <section class="featured-boxes">
      <div class="container">      
          <?php while( have_rows('featured_boxes_home', 'option') ): the_row(); 
            $title = get_sub_field('titulo');
            $image = get_sub_field('imagen');
            $button = get_sub_field('boton');
            $link = get_sub_field('link');
          ?>
              <div class="featured-box">
                <div class="col left">
                  <h3><?php echo $title; ?></h3>
                  <a href="<?php echo $link; ?>"><?php echo $button; ?></a>
                </div>
                <div class="col">                  
                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
              </div>
          <?php endwhile; ?>
      </div>
    </section>
    <?php endif; ?>              
	  
	<section class="home-featured-list">
      <div class="container">
        <h2 class="title">Nuevos ingresos</h2>

        <div class="itemsList">
        <?php
          $args = array(     
            'post_type' => 'product',
            'posts_per_page' => 4
          );           
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            get_template_part('partials/item-product-card');
          endwhile; endif; wp_reset_postdata();
        ?>
        </div>
      </div>
    </section>
  

    <section class="home-featured-list">
      <div class="container">
        <h2 class="title">Disco Intrépido</h2>

        <div class="itemsList">
        <?php
          $args = array(     
            'post_type' => 'product',            
            'posts_per_page' => 4,
            'orderby' => 'rand',
            'tax_query' => array(
              array(
              'taxonomy' => 'sello',
              'field' => 'term_id',
              'terms' => 27
              )
            ),
          );           
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            get_template_part('partials/item-product-card');
          endwhile; endif; wp_reset_postdata();
        ?>
        </div>
      </div>
    </section>

    
  </main>

<?php get_footer(); ?>
