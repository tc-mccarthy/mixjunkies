<?php // Custom Post Types

function post_type_slide() {

	/*************************** Slide Post Type ***************************/
	
	register_post_type('slide', array(
		'labels' => array('name' => __('Slides'), 'singular_label' => __('Slide'), 'add_new_item' => __('Add Slide'), 'search_items' => __('Search Slides'), 'edit_item' => __('Edit Slide')),
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "slide"),
		'menu_position' => 20,
		'with_front' => true,
		'supports' => array('title', 'editor', 'comments', 'author')
	));
	
	
	/*************************** Slide Categories ***************************/
	
	register_taxonomy('slide_categories', 'slide', array('show_in_nav_menus' => false, 'hierarchical' => true, 'labels' => array('name' => __('Slide Categories'), 'singular_label' => __('Slide Category'), 'add_new_item' => __('Add New Slide Category'), 'search_items' => __('Search Slide Categories'), 'edit_item' => __('Edit Slide Category')), 'rewrite' => array('slug' => 'slide-categories')));


	/*************************** Slide Page Layout ***************************/
	
	add_filter("manage_edit-slide_columns", "slide_edit_columns");
	add_action("manage_posts_custom_column",  "slide_custom_columns");
	
	function slide_edit_columns($columns){
			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => "Title",
				"slide_desc" => "Description",	
				"slide_categories" => "Categories",
				"slide_image" => "Image",				
				"date" => "Date"
			);
	
			return $columns;
	}
	
	function slide_custom_columns($column){
			global $post;
			require(ghostpool_inc . 'options.php');
			switch ($column)
			{
				case "slide_desc":
					echo excerpt(10);
					break;
				case "slide_categories":
					echo get_the_term_list($post->ID, 'slide_categories', '', ', ', '');
					break;
				case "slide_image":				
					if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_slide_image', true)) {
						$image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_slide_image', true), 50, 50, true);
						echo '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'" alt="" />';
					}			
					break;					
			}
	}

}

add_action('init', 'post_type_slide');

?>