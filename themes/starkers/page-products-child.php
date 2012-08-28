<?php
/**
 * Template Name: Products Child
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<h1>Our Most Advanced Technology</h1>
<div id="left_menu">
	<?php 
	// use wp_list_pages to display parent and all child pages - including all generations
	$parent = 17;
	$args=array(
	  'child_of' => $parent,
	  'title_li' => 'none'
	);
	$pages = get_pages($args);  
	if ($pages) {
	  $pageids = array();
	  foreach ($pages as $page) {
	    $pageids[]= $page->ID;
	  }

	  $args=array(
	    'title_li' => '',
	    'include' =>   implode(",", $pageids)
	  );
	  wp_list_pages($args);
	}
	?>
</div>
<div id="content" class="product_content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php if(get_field('tech_report_image')) {?>
		<div id="tech_report">
			<a href="#" id="tech_link"><img src="<?php bloginfo('template_url'); ?>/images/logo_ukas.jpg">
			<p>View Technical Report</p></a>
		</div>
		<?php }?>
		<div id="info">
			<?php the_content(); ?>
		</div>
		
		<div id="tech_report_info">
			<a href="#" id="product_back"><img src="<?php bloginfo('template_url'); ?>/images/arrow_small_left.png"> Back</a>
			<!-- Grab Tech Spec Image -->
			<img src="<?php the_field('tech_report_image');?>" class="tech_report_image">
		</div>
		
		
		
	<?php endwhile; ?>
</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>