<?php

//*************************** Portfolio ***************************//

function ghostpool_portfolio($atts, $content = null) {
	extract(shortcode_atts(array(
		'post_type' => 'post',
		'type' => 'three-col',
		'cats' => '',
		'col_height' => '',
		'image_width' => '',
		'image_height' => '',
		'per_page' => '9',
		'orderby' => 'date',
		'order' => 'desc',
		'excerpt_length' => '40',
		'title' => 'true',
		'title_link' => 'true',
		'read_more' => 'true',	
		'pagination' => 'true',
		'preload' => 'false'
	),$atts));

	require(ghostpool_inc . 'options.php');
	
	// Portfolio post type
	if(esc_attr($post_type) == 'page') { 
	$post_type = 'page';
	}

	// Portfolio Type
	if(esc_attr($type) == 'three-col') { 
	$type_class = 'portfolio-three-col';
	} elseif(esc_attr($type) == 'two-col') { 
	$type_class = 'portfolio-two-col';
	} elseif(esc_attr($type) == 'large') { 
	$type_class = 'portfolio-large';
	} elseif(esc_attr($type) == 'grid') { 
	$type_class = 'portfolio-grid';
	} elseif(esc_attr($type) == 'free') { 
	$type_class = 'portfolio-free';
	}

	// Columns
	$style_classes_1 = array('first','middle','last');
	$style_classes_2 = array('first','last');
	$style_classes_grid = array('first','middle','last');
	$style_index = 0;
	$counter = 0;
	
	// Order By
	if(esc_attr($orderby) == 'random') { 
	$orderby = "rand";
	} elseif(esc_attr($orderby) == 'title') { 
	$orderby = "title";
	} else {
	$orderby = "date";
	}
	
	// Order
	if(esc_attr($order) == 'asc') { 
	$order = "asc";
	} else {
	$order = "desc";
	}

	// Pagination	
	if (get_query_var('paged')) {
	$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
	} else {
	$paged = 1;
	}
	
	// Post Query	
	$args=array(
	'post_type' => $post_type,
	'post_status' => 'publish',
	'cat' => esc_attr($cats),
	'paged' => $paged,
	'caller_get_posts'=> 1,
	'orderby' => $orderby,
	'order' => $order,
	'posts_per_page' => $per_page
	);

	$featured_query = new wp_query($args); 
	//echo "Posts";
	//echo "Object : <pre>";print_r($featured_query);echo "</pre>";
	
	ob_start(); ?>
	
	<!--Begin Portfolio Container-->
	<div class="portfolio <?php echo $type_class; ?>">
		
		<?php while ($featured_query->have_posts()) : $featured_query->the_post(); global $wp_query, $paged, $post; $counter = $counter + 1;

		// Image Sizes
		if($type == "three-col") {
			if($image_width) {} else { $image_width = "288"; }
			if($image_height) {} else { $image_height = "210"; }
		} elseif($type == "two-col") {
			if($image_width) {} else { $image_width = "443"; }
			if($image_height) {} else { $image_height = "300"; }		
		} elseif($type == "large") {
			if($image_width) {} else { $image_width = "400"; }
			if($image_height) {} else { $image_height = "300"; }
		} elseif($type == "grid") {
			if($image_width) {} else { $image_width = "258"; }
			if($image_height) {} else { $image_height = "210"; }
		}
		
		// Video Type
		$flv = strpos(get_post_meta($post->ID, 'ghostpool_custom_url', true),".flv");
		$mp4 = strpos(get_post_meta($post->ID, 'ghostpool_custom_url', true),".mp4");
		$mp3 = strpos(get_post_meta($post->ID, 'ghostpool_custom_url', true),".mp3");
		
		?>

		<!--Begin Portfolio Three Columns-->
		
		<?php if($type == 'three-col') { ?>

			<div class="portfolio-item  columns three blank <?php $k = $style_index%3; echo "$style_classes_1[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('portfolio-loop.php'); ?>
			
			</div>
				
			<?php if($counter %3 == 0) { ?>
				<div class="clear"></div>
			<?php } ?>
			
		<?php } ?>
		
		<!--End Portfolio Three Columns-->
        
		<!--Begin Portfolio Free Form -->
		
		<?php if($type == 'free') { ?>

			<div class="portfolio-item  columns free blank <?php $k = $style_index%3; echo "$style_classes_1[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('portfolio-loop.php'); ?>
			
			</div>
				
			
		<?php } ?>
		
		<!--End Portfolio Free -->

		<!--Begin Portfolio Two Columns-->
		
		<?php if($type == 'two-col') { ?>

			<div class="portfolio-item columns two blank <?php $k = $style_index%2; echo "$style_classes_2[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('portfolio-loop.php'); ?>
			
			</div>
				
			<?php if($counter %2 == 0) { ?>
				<div class="clear"></div>
			<?php } ?>

		<?php } ?>
		
		<!--End Portfolio Two Columns-->		
		
		
		<!--Begin Portfolio Large-->
		
		<?php if($type == 'large') { ?>
				
			<div class="portfolio-item<?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('portfolio-loop.php'); ?>
			
			</div>
			
			<div class="divider"></div>
			
		<?php } ?>
		
		<!--End Portfolio Large-->


		<!--Begin Portfolio Grid-->
		
		<?php if($type == 'grid') { ?>

			<div class="portfolio-item columns three joint <?php if($counter > 3) { ?>level-class<?php } ?>  <?php $k = $style_index%3; echo "$style_classes_grid[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>">
						
				<?php require('portfolio-loop.php'); ?>
				
			</div>
				
			<?php if($counter %3 == 0) { ?>
				<div class="clear"></div>
			<?php } ?>
			
		<?php } ?>
		
		<!--End Portfolio Grid-->
		
	<?php endwhile; ?>
	
	</div>
	<!--End Portfolio Container-->

<?php

wp_reset_query();

if($pagination == "true") { gp_pagination($featured_query->max_num_pages); }



$output_string = ob_get_contents();
ob_end_clean(); 

return $output_string;

}
add_shortcode("portfolio", "ghostpool_portfolio");


function ghostpool_artists($atts, $content = null) {
	extract(shortcode_atts(array(
		'post_type' => 'page',
		'type' => 'grid',
		'cats' => '',
		'col_height' => '',
		'image_width' => '',
		'image_height' => '',
		'per_page' => '9',
		'orderby' => 'date',
		'order' => 'desc',
		'excerpt_length' => '40',
		'title' => 'true',
		'title_link' => 'true',
		'read_more' => 'true',	
		'pagination' => 'true',
		'preload' => 'false'
	),$atts));

	require(ghostpool_inc . 'options.php');
	

	// Portfolio Type
	if(esc_attr($type) == 'three-col') { 
	$type_class = 'portfolio-three-col';
	} elseif(esc_attr($type) == 'two-col') { 
	$type_class = 'portfolio-two-col';
	} elseif(esc_attr($type) == 'large') { 
	$type_class = 'portfolio-large';
	} elseif(esc_attr($type) == 'grid') { 
	$type_class = 'portfolio-grid';
	} elseif(esc_attr($type) == 'free') { 
	$type_class = 'portfolio-free';
	}

	// Columns
	$style_classes_1 = array('first','middle','last');
	$style_classes_2 = array('first','last');
	$style_classes_grid = array('first','middle','last');
	$style_index = 0;
	$counter = 0;
	
	// Order By
	if(esc_attr($orderby) == 'random') { 
	$orderby = "rand()";
	} elseif(esc_attr($orderby) == 'title') { 
	$orderby = "post_title";
	} else {
	$orderby = "post_date";
	}
	
	// Order
	if(esc_attr($order) == 'asc') { 
	$order = "asc";
	} else {
	$order = "desc";
	}

	// Pagination	
	if (get_query_var('paged')) {
	$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
	} else {
	$paged = 0;
	}
	
	// Post Query	
	$args=array(
	'post_type' => 'page',
	'post_status' => 'publish',
	'cat' => esc_attr($cats),
	'paged' => $paged,
	'caller_get_posts'=> 1,
	'orderby' => $orderby,
	'order' => $order,
	'posts_per_page' => $per_page
	);
	global $wpdb;
	$sq="SELECT * FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND ID IN (SELECT post_id FROM wp_mpc_pages_categories WHERE category_id='".esc_attr($cats)."') ";
	$artists = $wpdb->get_results($sq);
	$c=count($artists);
	
	$TotalPages = (int)$c/(int)$per_page;	
	$k = (int)$c - floor($TotalPages)*(int)$per_page;		
	if($k!=0) $TotalPages = floor($TotalPages)+1;
	$x = array("max_num_pages"=>$TotalPages); 
	$wp_query = (object) $x;
	
	$paged = ((int)$paged-1)*(int)$per_page; 
	if($paged<0) $paged = 0;
	
	$sq="SELECT * FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND ID IN (SELECT post_id FROM wp_mpc_pages_categories WHERE category_id='".esc_attr($cats)."') ORDER BY ".$orderby." ".$order." LIMIT $paged, $per_page ";
	$artists = $wpdb->get_results($sq);
	//echo count($artists);
	/*if($artists) {			 
		echo "yes <br />";
		foreach($artists as $author) {
			echo $author->post_title."<br />";
		}
	}	*/
	if($artists) {
		if(!function_exists("get_the_excerpt2")) {
			function get_the_excerpt2($post,  $deprecated = '' ) {
				if ( !empty( $deprecated ) )
					_deprecated_argument( __FUNCTION__, '2.3' );
			
				//global $post;
				$output = $post->post_content;
				if ( post_password_required($post) ) {
					$output = __('There is no excerpt because this is a protected post.');
					return $output;
				}
			
				return apply_filters('get_the_excerpt', $output);
			}
		}
		if(!function_exists("excerpt2")) {
			function excerpt2($limit,$post) {
				//echo get_the_excerpt2($post);
				$excerpt = get_the_excerpt2($post);
				$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
				$excerpt = preg_replace("/<img[^>]+\>/i", "", $excerpt);
				$excerpt = explode(' ', $excerpt, $limit);
				if (count($excerpt)>=$limit) {
					array_pop($excerpt);
					$excerpt = implode(" ",$excerpt).'...';
				} else {
					$excerpt = implode(" ",$excerpt);
				}	
				
				return $excerpt;
			}
		}
	}
	//$featured_query = new wp_query($args); 
	//echo "Posts";
	//echo "Object : <pre>";print_r($featured_query);echo "</pre>";
	
	ob_start(); ?>
	
	<!--Begin Portfolio Container-->
	<div class="portfolio <?php echo $type_class; ?>">
		
		
		<?php 
			
			
			//while ($featured_query->have_posts()) :
			
			if($artists)
			foreach($artists as $post) {
			//$featured_query->the_post(); 
			global $paged; $counter = $counter + 1;

		// Image Sizes
		if($type == "three-col") {
			if($image_width) {} else { $image_width = "288"; }
			if($image_height) {} else { $image_height = "210"; }
		} elseif($type == "two-col") {
			if($image_width) {} else { $image_width = "443"; }
			if($image_height) {} else { $image_height = "300"; }		
		} elseif($type == "large") {
			if($image_width) {} else { $image_width = "400"; }
			if($image_height) {} else { $image_height = "300"; }
		} elseif($type == "grid") {
			if($image_width) {} else { $image_width = "258"; }
			if($image_height) {} else { $image_height = "210"; }
		}
		
		// Video Type
		$flv = strpos(get_post_meta($post->ID, 'ghostpool_custom_url', true),".flv");
		$mp4 = strpos(get_post_meta($post->ID, 'ghostpool_custom_url', true),".mp4");
		$mp3 = strpos(get_post_meta($post->ID, 'ghostpool_custom_url', true),".mp3");
		
		?>

		<!--Begin Portfolio Three Columns-->
		
		<?php if($type == 'three-col') { ?>

			<div class="portfolio-item  columns three blank <?php $k = $style_index%3; echo "$style_classes_1[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('artist-loop.php'); ?>
			
			</div>
				
			<?php if($counter %3 == 0) { ?>
				<div class="clear"></div>
			<?php } ?>
			
		<?php } ?>
		
		<!--End Portfolio Three Columns-->
        
        <!--Begin Portfolio Free Form -->
		
		<?php if($type == 'free') { ?>

			<div class="portfolio-item  columns free artists blank <?php $k = $style_index%3; echo "$style_classes_1[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('artist-loop.php'); ?>
			
			</div>
				
			
		<?php } ?>
		
		<!--End Portfolio Free -->


		<!--Begin Portfolio Two Columns-->
		
		<?php if($type == 'two-col') { ?>

			<div class="portfolio-item columns two blank <?php $k = $style_index%2; echo "$style_classes_2[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('artist-loop.php'); ?>
			
			</div>
				
			<?php if($counter %2 == 0) { ?>
				<div class="clear"></div>
			<?php } ?>

		<?php } ?>
		
		<!--End Portfolio Two Columns-->		
		
		
		<!--Begin Portfolio Large-->
		
		<?php if($type == 'large') { ?>
				
			<div class="portfolio-item<?php if($preload == "true") { ?> preload<?php } ?>" style="height: <?php echo $col_height; ?>px;">
		
				<?php require('artist-loop.php'); ?>
			
			</div>
			
			<div class="divider"></div>
			
		<?php } ?>
		
		<!--End Portfolio Large-->


		<!--Begin Portfolio Grid-->
		
		<?php if($type == 'grid') { ?>

			<div class="portfolio-item columns three joint <?php if($counter > 3) { ?>level-class<?php } ?>  <?php $k = $style_index%3; echo "$style_classes_grid[$k]"; $style_index++; ?><?php if($preload == "true") { ?> preload<?php } ?>"  style="background-color:#FFFFFF; border:1px solid #999999; width:32%;">
						
				<?php require('artist-loop.php'); ?>
				
			</div>
				
			<?php if($counter %3 == 0) { ?>
				<div class="clear"></div>
			<?php } ?>
			
		<?php } ?>
		
		<!--End Portfolio Grid-->
		
	<?php  } //endwhile; ?>
	
	</div>
	<!--End Portfolio Container-->
	<div class="clear"></div>
	

<?php

wp_reset_query();

if($pagination == "true") { gp_pagination($wp_query->max_num_pages); }

echo '<div class="clear"></div>';

$output_string = ob_get_contents();
ob_end_clean(); 

return $output_string;

}
add_shortcode("artists", "ghostpool_artists");

?>