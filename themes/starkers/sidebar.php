<div id="sidebar">
<?php if ( function_exists ( dynamic_sidebar(1) ) ) : ?>

<?php dynamic_sidebar (1); ?>

<?php endif; ?>
<!-- Headline --><!--
	<div id="headline">
		<p>When we say we're environmentally responsible, we really mean it!</p><br />
		<p>Here's How.</p>
		<img src="<?php bloginfo( 'template_url' ); ?>/images/arrow_large_right.png">
	</div>
	<hr>-->
<!-- End Headline -->


<!-- RECENT POSTS -->
	<ul id="recent_posts">
		<?php $custom_query = new WP_Query('cat=-9'); // exclude category 9
		while($custom_query->have_posts()) : $custom_query->the_post(); ?>
		<?php static $count = 0;
			if ($count == "3") { break; }
		else { ?>


			<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php if ( has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<?php the_post_thumbnail(); ?>
						<img class="play_button" src="<?php bloginfo('template_url'); ?>/images/play_button.png">
					</a>
				<?php else : ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</li>
		<?php $count++; } ?>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); // reset the query ?>

	</ul>
	<a href="<?php bloginfo('url'); ?>/news">More News</a>
<!--  END RECENT POSTS -->

</div>