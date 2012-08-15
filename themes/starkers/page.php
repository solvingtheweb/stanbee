<?php
/**
 * Template Name: Page
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>

<?php endwhile; ?>
</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>