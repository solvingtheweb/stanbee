<div id="sidebar">
<?php if ( function_exists ( dynamic_sidebar(1) ) ) : ?>


<?php dynamic_sidebar (1); ?>



<?php endif; ?>

<!-- RECENT POSTS -->
<ul>
<?php
	$args = array( 'numberposts' => '5' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
	}
?>
</ul>
<!--  END RECENT POSTS -->
</div>