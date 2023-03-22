		<!-- footer -->
		<footer>
			<div class="container">
				<div class="row">
				<div class="col">
						<nav>
							<?php wp_nav_menu(array('menu' => 'Menu')); ?>
						</nav>
					</div>

					<div class="col">
						<div class="social">
							<a rel="noopener" target="_blank" href="https://www.facebook.com/discointrepido"><i class="fab fa-facebook-f"></i></a>
							<a rel="noopener" target="_blank" href="https://www.instagram.com/discointrepido/"><i class="fab fa-instagram"></i></a>							
							<a rel="noopener" target="_blank" href="https://open.spotify.com/user/xzbaz8qzatleo6kz6iequzlz0?si=f2dbd543ae8c4667"><i class="fab fa-spotify"></i></a>
						</div>						
					</div>
					
				</div>		

				<div class="row">
					<div class="col">
						<div class="terms">
							<?php wp_nav_menu(array('menu' => 'Menu B')); ?>
						</div>
					</div>

					<div class="col">
						<p><?php the_time('Y'); ?> - Disco Intrépido - Todos los derechos reservados.</p>
					</div>					
				</div>		
			</div>
		</footer>
		<!-- /footer -->

		<?php wp_footer(); ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-PEQYEMGQX1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-PEQYEMGQX1');
		</script>

	</body>
</html>