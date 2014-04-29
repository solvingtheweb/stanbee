<?php

class acf_Relationship extends acf_Field
{
	
	/*--------------------------------------------------------------------------------------
	*
	*	Constructor
	*
	*	@author Elliot Condon
	*	@since 1.0.0
	*	@updated 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function __construct($parent)
	{
    	parent::__construct($parent);
    	
    	$this->name = 'relationship';
		$this->title = __("Relationship",'acf');
		
		add_action('wp_ajax_acf_get_relationship_results', array($this, 'acf_get_relationship_results'));
   	}
   	
   	
   	/*--------------------------------------------------------------------------------------
	*
	*	acf_get_relationship_results
	*
	*	@author Elliot Condon
	*   @description: Generates HTML for Left column relationship results
	*   @created: 5/07/12
	* 
	*-------------------------------------------------------------------------------------*/
	
   	function acf_get_relationship_results()
   	{

   		// vars
		$options = array(
			'post_type'	=>	'',
			'taxonomy' => 'all',
			'posts_per_page' => 10,
			'paged' => 0,
			'orderby' => 'title',
			'order' => 'ASC',
			'post_status' => array('publish', 'private', 'draft', 'inherit', 'future'),
			'suppress_filters' => false,
			's' => ''
		);
		$ajax = isset( $_POST['action'] ) ? true : false;
		
		
		// override options with posted values
		if( $ajax )
		{
			$options = array_merge($options, $_POST);
		}
		
		
		// convert types
		$options['post_type'] = explode(',', $options['post_type']);
		$options['taxonomy'] = explode(',', $options['taxonomy']);
		
		
		// load all post types by default
		if( !$options['post_type'] || !is_array($options['post_type']) || $options['post_type'][0] == "" )
		{
			$options['post_type'] = get_post_types( array('public' => true) );
		}
		
		
		// attachment doesn't work if it is the only item in an array???
		if( is_array($options['post_type']) && count($options['post_type']) == 1 )
		{
			$options['post_type'] = $options['post_type'][0];
		}
		
		
		// create tax queries
		if( ! in_array('all', $options['taxonomy']) )
		{
			// vars
			$taxonomies = array();
			$options['tax_query'] = array();
			
			foreach( $options['taxonomy'] as $v )
			{
				
				// find term (find taxonomy!)
				// $term = array( 0 => $taxonomy, 1 => $term_id )
				$term = explode(':', $v); 
				
				
				// validate
				if( !is_array($term) || !isset($term[1]) )
				{
					continue;
				}
				
				
				// add to tax array
				$taxonomies[ $term[0] ][] = $term[1];
				
			}
			
			
			// now create the tax queries
			foreach( $taxonomies as $k => $v )
			{
				$options['tax_query'][] = array(
					'taxonomy' => $k,
					'field' => 'id',
					'terms' => $v,
				);
			}
		}
		
		unset( $options['taxonomy'] );
		
		
		// load the posts
		$posts = get_posts( $options );
		
		if( $posts )
		{
			foreach( $posts  as $post )
			{
				// find title. Could use get_the_title, but that uses get_post(), so I think this uses less Memory
				$title = apply_filters( 'the_title', $post->post_title, $post->ID );

				// status
				if($post->post_status != "publish")
				{
					$title .= " ($post->post_status)";
				}
				
				echo '<li><a href="javascript:;" data-post_id="' . $post->ID . '">' . $title . '<span class="add"></span></a></li>';
			}
		}
		
		
		// die?
		if( $ajax )
		{
			die();
		}
		
	}
	
	
   	/*--------------------------------------------------------------------------------------
	*
	*	admin_print_scripts / admin_print_styles
	*
	*	@author Elliot Condon
	*	@since 3.0.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function admin_print_scripts()
	{
		wp_enqueue_script(array(
			'jquery-ui-sortable',
		));
	}
	
	function admin_print_styles()
	{
  
	}
   		
	
	/*--------------------------------------------------------------------------------------
	*
	*	create_field
	*
	*	@author Elliot Condon
	*	@since 2.0.5
	*	@updated 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function create_field($field)
	{
		// vars
		$defaults = array(
			'post_type'	=>	'',
			'max' 		=>	-1,
			'taxonomy' 	=>	array('all'),
		);
		
		$field = array_merge($defaults, $field);
		
		
		// validate types
		$field['max'] = (int) $field['max'];
		
		
		// row limit <= 0?
		if( $field['max'] <= 0 )
		{
			$field['max'] = 9999;
		}
		
		
		// load all post types by default
		if( !$field['post_type'] || !is_array($field['post_type']) || $field['post_type'][0] == "" )
		{
			$field['post_type'] = get_post_types( array('public' => true) );
		}
		
		
		?>
<div class="acf_relationship" data-max="<?php echo $field['max']; ?>" data-s="" data-paged="1" data-post_type="<?php echo implode(',', $field['post_type']); ?>" data-taxonomy="<?php echo implode(',', $field['taxonomy']); ?>">
	
	<!-- Hidden Blank default value -->
	<input type="hidden" name="<?php echo $field['name']; ?>" value="" />
	
	<!-- Template for value -->
	<script type="text/html" class="tmpl-li">
	<li>
		<a href="#" data-post_id="{post_id}">{title}<span class="remove"></span></a>
		<input type="hidden" name="<?php echo $field['name']; ?>[]" value="{post_id}" />
	</li>
	</script>
	<!-- / Template for value -->
	
	<!-- Left List -->
	<div class="relationship_left">
		<table class="widefat">
			<thead>
				<tr>
					<th>
						<label class="relationship_label" for="relationship_<?php echo $field['name']; ?>"><?php _e("Search",'acf'); ?>...</label>
						<input class="relationship_search" type="text" id="relationship_<?php echo $field['name']; ?>" />
						<div class="clear_relationship_search"></div>
					</th>
				</tr>
			</thead>
		</table>
		<ul class="bl relationship_list">
			<li class="load-more">
				<div class="acf-loading"></div>
			</li>
		</ul>
	</div>
	<!-- /Left List -->
	
	<!-- Right List -->
	<div class="relationship_right">
		<ul class="bl relationship_list">
		<?php

		if( $field['value'] )
		{
			foreach( $field['value'] as $post )
			{
				
				// find title. Could use get_the_title, but that uses get_post(), so I think this uses less Memory
				$title = apply_filters( 'the_title', $post->post_title, $post->ID );


				// status
				if($post->post_status == "private" || $post->post_status == "draft")
				{
					$title .= " ($post->post_status)";
				}
				
				echo '<li>
					<a href="javascript:;" class="" data-post_id="' . $post->ID . '">' . $title . '<span class="remove"></span></a>
					<input type="hidden" name="' . $field['name'] . '[]" value="' . $post->ID . '" />
				</li>';
			}
		}
			
		?>
		</ul>
	</div>
	<!-- / Right List -->
	
</div>
		<?php

	
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	create_options
	*
	*	@author Elliot Condon
	*	@since 2.0.6
	*	@updated 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function create_options($key, $field)
	{
		// vars
		$defaults = array(
			'post_type'	=>	'',
			'max' 		=>	'',
			'taxonomy' 	=>	array('all'),
		);
		
		$field = array_merge($defaults, $field);
		
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label for=""><?php _e("Post Type",'acf'); ?></label>
			</td>
			<td>
				<?php 
				
				$choices = array(
					''	=>	__("All",'acf')
				);
				
				$post_types = get_post_types( array('public' => true) );
				
				foreach( $post_types as $post_type )
				{
					$choices[$post_type] = $post_type;
				}
				
				$this->parent->create_field(array(
					'type'	=>	'select',
					'name'	=>	'fields['.$key.'][post_type]',
					'value'	=>	$field['post_type'],
					'choices'	=>	$choices,
					'multiple'	=>	'1',
				));
				
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Filter from Taxonomy",'acf'); ?></label>
			</td>
			<td>
				<?php 
				$choices = array(
					'' => array(
						'all' => __("All",'acf')
					)
				);
				$choices = array_merge($choices, $this->parent->get_taxonomies_for_select());
				$this->parent->create_field(array(
					'type'	=>	'select',
					'name'	=>	'fields['.$key.'][taxonomy]',
					'value'	=>	$field['taxonomy'],
					'choices' => $choices,
					'optgroup' => true,
					'multiple'	=>	'1',
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Maximum posts",'acf'); ?></label>
			</td>
			<td>
				<?php 
				$this->parent->create_field(array(
					'type'	=>	'text',
					'name'	=>	'fields['.$key.'][max]',
					'value'	=>	$field['max'],
				));
				?>
			</td>
		</tr>
		<?php
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	get_value
	*
	*	@author Elliot Condon
	*	@since 3.3.3
	* 
	*-------------------------------------------------------------------------------------*/
	
	function get_value($post_id, $field)
	{
		// get value
		$value = parent::get_value($post_id, $field);
		
		
		// empty?
		if( !$value )
		{
			return $value;
		}
		
		
		// Pre 3.3.3, the value is a string coma seperated
		if( !is_array($value) )
		{
			$value = explode(',', $value);
		}
		
		
		// empty?
		if( empty($value) )
		{
			return $value;
		}
		
		
		// find posts (DISTINCT POSTS)
		$posts = get_posts(array(
			'numberposts' => -1,
			'post__in' => $value,
			'post_type'	=>	get_post_types( array('public' => true) ),
			'post_status' => array('publish', 'private', 'draft', 'inherit', 'future'),
		));

		
		$ordered_posts = array();
		foreach( $posts as $post )
		{
			// create array to hold value data
			$ordered_posts[ $post->ID ] = $post;
		}
		
		
		// override value array with attachments
		foreach( $value as $k => $v)
		{
			$value[ $k ] = $ordered_posts[ $v ];
		}
		
				
		// return value
		return $value;	
	}
	

	
}

?>