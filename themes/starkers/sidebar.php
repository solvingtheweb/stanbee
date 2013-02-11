<div id="sidebar">
<?php if ( function_exists ( dynamic_sidebar(1) ) ) : ?>

<?php dynamic_sidebar (1); ?>

<?php endif; ?>
<!-- Headline -->
	<div id="headline">
		<p>When we say we're environmentally responsible, we really mean it!</p><br />
		<p>Here's How.</p>
		<img src="<?php bloginfo( 'template_url' ); ?>/images/arrow_large_right.png">
	</div>
<!-- End Headline -->

<!-- RECENT POSTS -->
	<ul id="recent_posts">
		<?php
			$args = array( 'numberposts' => '3' );
				$recent_posts = wp_get_recent_posts( $args );
				foreach( $recent_posts as $recent ){
					if($recent->post_status  == "publish"){ 
						echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
					}
				}
		?>
	</ul>
<!--  END RECENT POSTS -->
</div>