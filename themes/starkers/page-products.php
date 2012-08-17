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
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>

<?php
	$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

	foreach( $mypages as $page ) {		
		$content = $page->post_content;
		if ( ! $content ) // Check for empty page
			continue;

		$content = apply_filters( 'the_content', $content );
	?>
		<h2><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>
		<div class="entry"><?php echo $content; ?></div>
		<?php
			$mypages = get_pages( array( 'child_of' => $page->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

			foreach( $mypages as $page ) {		
				$content = $page->page_content;
				if ( ! $content ) // Check for empty page
					continue;

				$content = apply_filters( 'the_content', $content );
			?>
				<h2><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>

				<div class="entry"><?php echo $content; ?></div>
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