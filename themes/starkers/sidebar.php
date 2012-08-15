<div id="sidebar">
<?php if ( function_exists ( dynamic_sidebar(1) ) ) : ?>

<?php dynamic_sidebar (1); ?>

<?php endif; ?>

<!-- Headline -->
<p>When we say we're environmentally responsible, we really mean it!</p>
<p>Here's How.</p>
<img src="<?php bloginfo( 'template_url' ); ?>/images/arrow_large_right.png">
<!-- End Headline -->

<!-- RECENT POSTS -->
<ul>
<?php
	$args = array( 'numberposts' => '3' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
	}
?>
</ul>
<!--  END RECENT POSTS -->
</div>