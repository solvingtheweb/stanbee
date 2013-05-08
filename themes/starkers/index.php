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
<div id="page_headline">
	<h2 class="page_title">New and Noteworthy</h2>
</div>
<div id="content">
	<?php if ( have_posts() ): ?>
		<ul id="recent_posts">
			<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<article>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<?php the_post_thumbnail('medium'); ?>
					</a>
					<?php the_excerpt(); ?>
				</article>
			</li>
			<?php endwhile; ?>
			</ul>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">&laquo;</span> Previous Page') ); ?></div>
				<?php endif; ?>
				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( 'Next Page <span class="meta-nav">&raquo;</span>') ); ?></div>
				<?php endif; ?>
	<?php else: ?>
		<h2>No posts to display</h2>
	<?php endif; ?>
</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>