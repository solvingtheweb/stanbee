<?php
/**
 * Template Name: Contacts
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
	<h2 class="page_title">Contacts</h2>
</div>
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>


<?php endwhile; ?>

</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>