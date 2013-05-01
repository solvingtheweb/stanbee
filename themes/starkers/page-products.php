<?php
/**
 * Template Name: Products
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<div id="content" class="content_nobg">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


<?php
	$mypages = get_pages( array( 'child_of' => $post->ID, 'parent' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'asc' ) );

	foreach( $mypages as $page ) {		
		$content = $page->post_content;
		if ( ! $content ) // Check for empty page
			continue;

		$content = apply_filters( 'the_content', $content );
	?>
		
		<h2 class="product_category"><?php echo $page->post_title; ?></h2>
		
		<ul class="page-id-<?php echo $post->ID; ?>">
			<?php
				$childpages = get_pages( array( 'child_of' => $page->ID, 'parent' => $page->ID, 'sort_column' => 'post_date', 'sort_column' => 'menu_order' ) );
            	
				foreach( $childpages as $childpage ) {		
					$content = $childpage->post_content;
					if ( ! $content ) // Check for empty page
						continue;
            	
					$content = apply_filters( 'the_content', $content );
			?>
				<li id="product">
				<h2 class="product_name"><a href="<?php echo get_page_link( $childpage->ID ); ?>"><?php echo $childpage->post_title; ?></a></h2>
				<?php $other_page = $childpage->ID;	?>
				<?php
					$child_page = $childpage->ID;
					if(get_field('spec1', $child_page)) {echo '<p>' . get_field('spec1', $child_page) . '</p>';}
					if(get_field('spec2', $child_page)) {echo '<p>' . get_field('spec2', $child_page) . '</p>';}
					if(get_field('spec3', $child_page)) {echo '<p>' . get_field('spec3', $child_page) . '</p>';}
					if(get_field('spec4', $child_page)) {echo '<p>' . get_field('spec4', $child_page) . '</p>';}
					if(get_field('spec5', $child_page)) {echo '<p>' . get_field('spec5', $child_page) . '</p>';}
					if(get_field('spec6', $child_page)) {echo '<p>' . get_field('spec6', $child_page) . '</p>';}
				?>
				</li><!-- END product-->
				<?php
				}	
			?>
		
	<?php
	}	
?>

<?php endwhile; ?>

</div><!-- END CONTENT -->

<?php get_sidebar(); ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>