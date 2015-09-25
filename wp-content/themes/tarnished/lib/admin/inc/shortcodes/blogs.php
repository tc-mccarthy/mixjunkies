<?php

//*************************** Blog ***************************//

function ghostpool_blog($atts, $content = null) {
	extract(shortcode_atts(array(
		'images' => 'true',
		'cats' => '',
		'image_width' => '200',
		'image_height' => '225',
		'per_page' => '6',
		'orderby' => 'date',
		'order' => 'desc',
		'offset' => '0',
		'excerpt_length' => '40',
		'full_content' => 'false',
		'title' => 'true',
		'meta' => 'true',
		'pagination' => 'true',
		'preload' => 'false',
		'wrap' => 'true'
	),$atts));

	require(ghostpool_inc . 'options.php');
	
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
	'post_type' => 'post',
	'post_status' => 'publish',
	'cat' => esc_attr($cats),
	'paged' => $paged,
	'caller_get_posts'=> 1,
	'orderby' => $orderby,
	'order' => $order,
	'posts_per_page' => esc_attr($per_page),
	'offset' => $offset
	);

	$featured_query = new wp_query($args); 
	
	ob_start(); ?>
	
	<!--Begin Blog Container-->
	<div class="blog-wrapper">

	<?php while ($featured_query->have_posts()) : $featured_query->the_post(); global $wp_query, $paged, $post; $counter = $counter + 1; 

	?>
	
		<!--Begin Post-->
		<div class="post<?php if($preload == "true") { ?> preload<?php } ?><?php if($counter == 1) { ?> first<?php } ?>">
		
			<!--Begin Image-->
			<?php if((has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_thumbnail', true)) && $images == "true") { ?>
			
				<div class="post-thumbnail<?php if($wrap == "false") { ?> no-wrap<?php } ?>">

					<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image" OR get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?>
						<a href="<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?>file=<?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?>&amp;image=<?php echo get_image_path(get_post_meta($post->ID, 'ghostpool_thumbnail', true)); ?><?php } else { ?><?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?><?php } ?>" rel="prettyPhoto[gallery]">
					<?php } else { ?>
						<a href="<?php if(get_post_meta($post->ID, 'ghostpool_custom_url', true)) { ?><?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?><?php } else { ?><?php the_permalink(); ?><?php } ?>">
					<?php } ?>
	
						<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image") { ?><span class="hover-image"></span><?php } elseif(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?><span class="hover-video"></span><?php } ?>
					
						<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_thumbnail', true), $image_width, $image_height, true); ?>
						<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />
					
					</a>
			
				</div>
			
			<?php } ?>
			<!--End Image-->

			<div class="post-text">
			
				<?php if(esc_attr($title) == 'true') { ?><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php } ?>
				
				<?php if(esc_attr($meta) == "true") { ?>
					<div class="post-creator"><?php echo gp_by; ?> <?php the_author_link(); ?></div>
				<?php } ?>
				
				<?php if($full_content == 'false') { ?>
				
					<?php if(esc_attr($excerpt_length) == '0') {} elseif(esc_attr($excerpt_length) != '0') { ?><p><?php echo excerpt($excerpt_length); ?></p><?php } ?>
				
				<?php } else { global $more; $more = 0; ?>
				
					<?php the_content(); ?>
				
				<?php } ?>
				
				<?php if(esc_attr($meta) == "true") { ?>
					<div class="post-meta"><span class="post-date"><?php the_time('d, F Y'); ?></span><span class="post-cats"><?php the_category(' '); ?></span><?php if('open' == $post->comment_status) { ?><span class="post-comments"><?php comments_popup_link(gp_no_comments, gp_one_comment, gp_more_comments, 'comments-link', ''); ?></span><?php } ?></div>
				<?php } ?>
				
			</div>
		
		</div>

		<div class="post-divider clear"></div>
		
		<!--End Post-->
	
	<?php endwhile; ?>
	
	</div>
	
	<div class="clear"></div>
	
	<!--End Blog Container-->

<?php

wp_reset_query();

if($pagination == "true") { gp_pagination($featured_query->max_num_pages); }

$output_string = ob_get_contents();
ob_end_clean(); 

return $output_string;

}

add_shortcode("blog", "ghostpool_blog");

?>