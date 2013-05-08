<?php
/**
 * Template Name: Company
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
	<h2 class="page_title">Our Company</h2>
</div>
<div id="left_menu">
	<?php wp_list_pages('title_li=&child_of=7');
	?>
</div>
<div id="content" class="product_content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>


<?php endwhile; ?>

</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>