<?php
/**
 * Template Name: Single
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<div id="page_headline">
	<h2 class="page_title">New and Noteworthy</h2>
</div>	
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article>

	<h2><?php the_title(); ?></h2>
	<!--<time datetime="<?php the_time( 'Y-m-D' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> -->
	<?php if ( has_post_video()) : ?>
		<div class="post_video"><?php the_post_video(); ?></div>
	<?php else :
		the_post_thumbnail();
	endif; ?>
	<div><?php the_content(); ?></div>



</article>
<?php endwhile; ?>
</div> <!-- End Content -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>