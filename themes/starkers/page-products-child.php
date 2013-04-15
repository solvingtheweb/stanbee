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
<div id="page_headline">
<h1>Our Most Advanced Technology</h1>
</div>
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
		<?php if(get_field('satra_test_results') || get_field('product_data_sheet')) {?>
		<div id="tech_report">
			<?php
			if(get_field('satra_test_results')) {echo '<a href="#" id="satra_test_results_link"><p>View Satra Test Results</p></a>';}
			if(get_field('product_data_sheet')) {echo '<a href="#" id="product_data_sheets_link"><p>View Product Data Sheet</p></a>';}
			?>

		</div>
		<?php }?>
		<div id="info">
			<?php the_content(); ?>
		</div>
		
		<div id="satra_test_results">
			<a href="#" id="product_back_satra"><img src="<?php bloginfo('template_url'); ?>/images/arrow_small_left.png"> Back</a>
			
			<?php if(get_field('satra_test_results')): ?>
				<ul>
				<?php while(has_sub_field('satra_test_results')): ?>
					<li><a href="<?php the_sub_field('satra_report_file'); ?>"><?php the_sub_field('satra_report_name')?></a></li>
				<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<p>No results available at this time.</p>
			<?php endif; ?>
	
		</div>
		
		<div id="product_data_sheets">
			<a href="#" id="product_back_tech"><img src="<?php bloginfo('template_url'); ?>/images/arrow_small_left.png"> Back</a>
			
			<?php if(get_field('product_data_sheet')): ?>
				<ul>
				<?php while(has_sub_field('product_data_sheet')): ?>
					<li><a href="<?php the_sub_field('data_sheet_file'); ?>"><?php the_sub_field('data_sheet_name')?></a></li>
				<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<p>No data sheets available at this time.</p>
			<?php endif; ?>
			
		</div>
		
		
		
	<?php endwhile; ?>
</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>