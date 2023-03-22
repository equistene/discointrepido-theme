<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title('|',true,'right'); ?> <?php bloginfo('name'); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="<?php bloginfo('charset'); ?>">

		<!-- FAVICONS -->
		<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/img/icons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/img/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/img/icons/favicon-16x16.png">
		<link rel="manifest" href="<?php bloginfo('template_url'); ?>/img/icons/manifest.json">
		<meta name="theme-color" content="#ffffff">
		<link rel="manifest" href="<?php bloginfo('template_url'); ?>/site.webmanifest">
		<link rel="mask-icon" href="<?php bloginfo('template_url'); ?>/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#000000">

		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://kit.fontawesome.com/3dfad85c20.js" crossorigin="anonymous"></script>

		<style>
			:root{
				--primary-color: #ffd561;
				--contrast-color: #000000;
			}
		</style>

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

	<!-- header -->
	<header>				
		<div class="container full">			
			<a class="logo" href="<?php echo get_option('home'); ?>">
				<h1>Disco Intrépido</h1>
				<!-- <img src="<?php bloginfo('template_url'); ?>/img/logo-blanco.png" alt="Disco Intrepido"> -->
			</a>			

			<nav>
				<?php wp_nav_menu(array('menu' => 'Menu')); ?>
			</nav>

			<div class="right">
				<?php if ( WC()->cart->get_cart_contents_count() > 0 ): ?>
					<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">					
						<i class="fas fa-shopping-cart"></i>
						<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> – <?php echo WC()->cart->get_cart_total(); ?>
					</a>					
				<?php endif; ?>	

				<button id="headerSearch" class="headerSearch"><i class="fas fa-search"></i></button>

				<button id="menuHeader" class="menuHeader"><i class="fas fa-bars"></i></button>	
			</div>					
		</div>

		<?php get_template_part('product-searchform'); ?>

		<section class="menu-mobile-nav">
			<nav>
				<?php wp_nav_menu(array('menu' => 'Menu')); ?>
			</nav>
		</section>
	</header>
	<!-- /header -->

<?php if(get_field('featured_header', 'option')): ?>
	<section class="featuredNews">
		<a href="<?php the_field('featured_header_link', 'option') ?>"><?php the_field('featured_header_text', 'option') ?></a>
	</section>
<?php endif; ?>