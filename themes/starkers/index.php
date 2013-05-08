<?php
/**
 * Template Name: Home
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<div id="content">
<?php if ( have_posts() ): ?>
<h2>Latest Posts</h2>	
<ul id="recent_posts">
<?php while ( have_posts() ) : the_post(); ?>
<li>
		<article>
			<h1><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<time datetime="<?php the_time( 'Y-m-D' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
			<?php the_post_video(); ?>
			<?php the_excerpt(); ?>
		</article>
</li>
<?php endwhile; ?>
</ul>
<?php else: ?>
<h2>No posts to display</h2>
<?php endif; ?>
</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>