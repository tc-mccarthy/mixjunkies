<?php

//*************************** Accordion Slider ***************************//

function ghostpool_accordion_slider($atts, $content = null) {
	extract(shortcode_atts(array(
		'name' => 'accordionslider',
		'type' => 'horizontal',
        'cats' => '',
        'slides' => '5',
        'width' => '980',
        'height' => '440',    
        'max_slide' => '',
        'sticky' => 'false',
        'sticky_number' => '0',
        'expand_on' => 'mouseover',
        'align' => 'alignnone',
        'preload' => 'true'
	),$atts));

	require(ghostpool_inc . 'options.php');
	global $wp_query, $post; 

	// Remove spaces from slider name
	$slider_name = preg_replace('/[^a-zA-Z0-9]/', '', $name);
	
	// Slide Number
	if($_GET['type'] == "full" OR ($type == "full" && $_GET['type'] == "")) { 
	$slides = "1";
	} else {
	$slides;
	}

	// Slider Query	
	if($cats) {
	
		$args=array(
		'post_type' => 'slide',
		'post_status' => 'publish',
		'paged' => $paged,
		'caller_get_posts' => 1,
		'posts_per_page' => $slides,
		'tax_query' => array('relation' => 'OR', array('taxonomy' => 'slide_categories', 'terms' => explode(',', $cats), 'field' => 'id'))
		);
	
	} else {
	
		$args=array(
		'post_type' => 'slide',
		'post_status' => 'publish',
		'paged' => $paged,
		'caller_get_posts' => 1,
		'posts_per_page' => $slides,
		);
		
	}
		
	$featured_query = new wp_query($args);

	ob_start(); ?>
	
	<div class="accordion-slider <?php echo $align; ?>" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
		
		<?php
		
		//*************************** Full ***************************//
		
		if($_GET['type'] == "full" OR ($type == "full" && $_GET['type'] == "")) {
		
			if ($featured_query->have_posts()) : 
			
			$image_max_width = $width;
			$image_max_height = $height;
			
			?>
		
			<ul id="<?php echo $slider_name; ?>" class="full<?php if($preload == "true") { ?> preload<?php } ?>" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
			
				<?php while ($featured_query->have_posts()) : $featured_query->the_post(); $slide_counter++; 
				
				// Image Crop
				if(get_post_meta($post->ID, 'ghostpool_slide_crop', true) == "None") {
					$image_crop = "0";
				} elseif(get_post_meta($post->ID, 'ghostpool_slide_crop', true) == "Proportional (Borders)") {
					$image_crop = "2";
				} else {
					$image_crop = "1";
				}
				
				// Image Crop Position
				if(get_post_meta($post->ID, 'ghostpool_slide_crop_position', true) == "Top") {
					$image_crop_position = "t";
				} elseif(get_post_meta($post->ID, 'ghostpool_slide_crop_position', true) == "Bottom") {
					$image_crop_position = "b";
				} else {
					$image_crop_position = "c";
				}	
			
				?>
			
					<li class="panel">
						
						<?php require('accordion-loop.php'); ?>
						
					</li>
					
				<?php endwhile; ?>
								
			</ul>
			
			<?php else : ?>
				
				<div class="columns one last separate"><div>Oops, you haven't set your slider up correctly. Make sure you have created some slides from Slides > Add New and slide categories from Slides > Slide Categories.</div></div>
				
			<?php endif; wp_reset_query(); ?>	
		
		<?php
		
		//*************************** Horizontal/Vertical ***************************//
		
		} else { 
		
		$vertical_min_height = ceil($height / $slides);
		$vertical_max_height = ceil($height / 1.5);
		$horizontal_min_width = ceil($width / $slides);
		$horizontal_max_width = ceil($width / 1.5);
		
		if($_GET['type'] == "vertical" OR ($type == "vertical" && $_GET['type'] == "")) {
			$image_max_width = $width;
			$image_min_width = $width;
			$image_min_height = $vertical_min_height;
			if($max_slide) { $image_max_height = $max_slide; } else { $image_max_height = $vertical_max_height; }		
			$caption_width = $width;
		} elseif($_GET['type'] == "horizontal" OR ($type == "horizontal" && $_GET['type'] == "")) {			
			$image_min_width = $horizontal_min_width;
			if($max_slide) { $image_max_width = $max_slide; } else { $image_max_width = $horizontal_max_width; }						
			$image_min_height = $height;
			$image_max_height = $height;
			if($max_slide) { $caption_width = $max_slide; } else { $caption_width = $horizontal_max_width; }	
		}
		
			if ($featured_query->have_posts()) : 
		
		?>
	
			<ul id="<?php echo $slider_name; ?>" class="<?php if($_GET['type'] == "vertical" OR ($type == "vertical" && $_GET['type'] == "")) { ?>vertical<?php } elseif($_GET['type'] == "horizontal" OR ($type == "horizontal" && $_GET['type'] == "")) { ?>horizontal<?php } ?><?php if($preload == "true") { ?> preload<?php } ?>" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
			
				<?php while ($featured_query->have_posts()) : $featured_query->the_post(); global $wp_query; $post->ID = $GLOBALS['post']->ID; $slide_counter++;
				
				// Image Crop
				if(get_post_meta($post->ID, 'ghostpool_slide_crop', true) == "None") {
					$image_crop = "0";
				} elseif(get_post_meta($post->ID, 'ghostpool_slide_crop', true) == "Proportional (Borders)") {
					$image_crop = "2";
				} else {
					$image_crop = "1";
				}
				
				// Image Crop Position
				if(get_post_meta($post->ID, 'ghostpool_slide_crop_position', true) == "Top") {
					$image_crop_position = "t";
				} elseif(get_post_meta($post->ID, 'ghostpool_slide_crop_position', true) == "Bottom") {
					$image_crop_position = "b";
				} else {
					$image_crop_position = "c";
				}	

				?>
				
					<li class="panel" style="width: <?php echo $image_min_width; ?>px; height: <?php echo $image_min_height; ?>px;">
					
						<?php require('accordion-loop.php'); ?>
						
					</li>
				
				<?php endwhile; ?>

			</ul>

			<?php else : ?>
				
				<div class="columns one last separate"><div>Oops, you haven't set your slider up correctly. Make sure you have created some slides from Slides > Add New and slide categories from Slides > Slide Categories.</div></div>
				
			<?php endif; wp_reset_query(); ?>
	
			<script>
				jQuery(document).ready(function(){
					jQuery("#<?php echo $slider_name; ?>").kwicks({
						max: <?php if($max_slide) { echo $max_slide; } elseif($_GET['type'] == "vertical" OR ($type == "vertical" && $_GET['type'] == "")) { echo $vertical_max_height; } elseif($_GET['type'] == "horizontal" OR ($type == "horizontal" && $_GET['type'] == "")) { echo $horizontal_max_width; } ?>,
						spacing: 0,
						sticky: <?php echo $sticky; ?>,
						defaultKwick: <?php echo $sticky_number; ?>,
						event: "<?php if($expand_on == 'click') { ?>click<?php } else { ?>mouseover<?php } ?>",
						isVertical: <?php if($_GET['type'] == "vertical" OR ($type == "vertical" && $_GET['type'] == "")) { ?>true<?php } elseif($_GET['type'] == "horizontal" OR ($type == "horizontal" && $_GET['type'] == "")) { ?>false<?php } ?>
					});
				});
			</script>
	
		<?php } ?>

	</div>	

<?php

$output_string = ob_get_contents();
ob_end_clean(); 

return $output_string;

}
add_shortcode("accordion_slider", "ghostpool_accordion_slider");

?>