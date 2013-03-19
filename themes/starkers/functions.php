<?php

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'init', 'script_enqueuer' ); 

	add_filter( 'body_class', 'add_slug_to_body_class' );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function script_enqueuer() {

		if( ! is_admin() ) {
			wp_register_script( 'site', get_stylesheet_directory_uri().'/js/site.js', array( 'jquery' ) );
			wp_enqueue_script( 'site' );
				
		};
	}
	
	
	/* ========================================================================================================================
	
	Sidebar
	
	======================================================================================================================== */
	
	
	
	if ( function_exists ('register_sidebar')) { 
	    register_sidebar ('custom'); 
	}	



	/* ========================================================================================================================
	
	Menus
	
	======================================================================================================================== */

	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'footer_menu' => 'Footer Menu'
	  		)
	  	);
	}


	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif; ?>
		</li>
		<?php 
	}
	

	/* ========================================================================================================================
	
	Make all child pages use one template
	
	======================================================================================================================== */	
	
	$page_children = get_pages('child_of=29');
	foreach($page_children as $child){
		$current_page_template = get_post_meta($child->ID,'_wp_page_template',true);
		if($current_page_template != 'page-products-child.php') update_post_meta($child->ID,'_wp_page_template','page-products-child.php');
	}


	// Add theme support for post thumbnails 
	add_theme_support('post-thumbnails');
	add_image_size( 'custom_thumb', 254, 254, true);

	// Add thumbnail to excerpt
	add_filter( 'the_excerpt', 'excerpt_thumbnail' );
	function excerpt_thumbnail($excerpt){
	    if(is_single()) return $excerpt;
	    global $post;
	    if ( has_post_thumbnail() ) {
	        $img .= '<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'custom_thumb').'</a>';
	    } else {
	        $img = '';
	    }
	    return $img.$excerpt;
	}
?>