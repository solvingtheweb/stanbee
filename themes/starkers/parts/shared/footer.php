	
	<footer>
		<div class="footer_info">
			<div id="copyright">
				&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
			</div>
			<div id="footer_nav">
				<?php wp_nav_menu( array('menu' => 'Footer Menu' )); ?>
			</div>
		</div>
		<img class="footprint" src="<?php bloginfo( 'template_url' ); ?>/images/footprint.png">
	</footer>
	</div><!-- END CONTAINER -->
