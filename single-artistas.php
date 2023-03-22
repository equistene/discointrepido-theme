<?php get_header(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article class="single-artista">

			<h1><?php the_title(); ?></h1>	

      <div class="topImage container">
        <?php the_post_thumbnail('large'); ?>
      </div>

      <div class="content container">
        <h3 class="subtitle">Acerca</h3>
        <?php the_content();  ?>			
      </div>

      <div class="social container">
        <h3 class="subtitle">Sigue a <?php the_title(); ?></h3>
        <ul>
          <?php if(get_field('instagram')): ?>
            <li>
              <a href="<?php the_field('instagram') ?>">
                <i class="fab fa-instagram"></i>                
              </a>
            </li>
          <?php endif; ?>

          <?php if(get_field('twitter')): ?>
            <li>
              <a href="<?php the_field('twitter') ?>">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
          <?php endif; ?>

          <?php if(get_field('facebook')): ?>
            <li>
              <a href="<?php the_field('facebook') ?>">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
          <?php endif; ?>

          <?php if(get_field('spotify')): ?>
            <li>
              <a href="<?php the_field('spotify') ?>">
                <i class="fab fa-spotify"></i>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>

      <?php if(get_field('mostrar_tienda')): ?>
      <div class="store container">
        <h3 class="subtitle"><?php the_title(); ?> en nuestra tienda</h3>      

        <div class="itemsList">
        <?php
          $artistProd = get_field('productos_tienda');          
          $args = array(     
            'post_type' => 'product',            
            'posts_per_page' => 9,
            'tax_query' => array(
              array(
                  'taxonomy' => 'Artista',
                  'field'    => 'id',
                  'terms'    => $artistProd,
              ),
            ),      
          );           
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            get_template_part('partials/item-product-card');
          endwhile; endif; wp_reset_postdata();
        ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if(get_field('mostrar_blog')): ?>
      <div class="blog container">
        <h3 class="subtitle"><?php the_title(); ?> en nuestro blog</h3>

        <div class="itemsPosts">
        <?php
          $artistTag = get_field('posts_blog');          
          $args = array(     
            'post_type' => 'post',
            'posts_per_page' => 3,
            'tax_query' => array( 'tag_id' => $artistTag ),
          );           
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            get_template_part('partials/item-post');
          endwhile; endif; wp_reset_postdata();
        ?>  
        </div>      
      </div>
      <?php endif; ?>

      <?php if(get_field('mostrar_multimedia')): ?>
      <div class="videos container">
        <h3 class="subtitle">Videos</h3>

        <?php if( have_rows('videos') ): ?>
            <ul class="items">
            <?php while( have_rows('videos') ): the_row(); ?>
                <li>                    
                  <?php the_sub_field('video'); ?>
                </li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>

      </div>

      <div class="audios container">
        <h3 class="subtitle">Música</h3>

        <?php if( have_rows('audios') ): ?>
            <ul class="items">
            <?php while( have_rows('audios') ): the_row(); ?>
                <li>                    
                  <?php the_sub_field('audio'); ?>
                </li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
      </div>
      <?php endif; ?>

		</article>		

	<?php endwhile; endif; ?>
	
<?php get_footer(); ?>