<div class="item-post">  
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail('medium'); ?>
      <div class="data">
        <h2><?php the_title(); ?></h2>      
        <p><?php the_time('d - F - Y'); ?></p>
      </div>      
    </a>  
</div>