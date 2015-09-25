<?php

//*************************** Related Posts ***************************//

function ghostpool_related_posts($atts, $content = null) {
	extract(shortcode_atts(array(
        'limit' => '6',
        'id' => ''
    ), $atts));
	
	global $wp_query;
	$post->ID = $GLOBALS['post']->ID;

	if($id == '') {
	$id = $post->ID;
	} else {
	$id;
	}

	$tags = wp_get_post_tags($id);
	$tempQuery = $wp_query;
	
	if($tags) {
	$tag_ids = array();
	
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	
	$newQuery=array(
	'tag__in' => $tag_ids,
	'post__not_in' => array($id),
	'posts_per_page' => $limit,
	'orderby' => rand,
	'caller_get_posts' => 1);
	
	query_posts($newQuery);
	
	require(ghostpool_inc . 'options.php');
	
	ob_start(); ?>
	
		<div class="clear"></div>
		
		<div id="related-posts">
			
			<h3>Related Posts</h3>
			
			<?php while (have_posts()) : the_post(); $post->ID = $GLOBALS['post']->ID; ?>
			
				<div class="related-post">				
					
					<?php if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>	
					
						<div class="related-image">
						
							<a href="<?php the_permalink(); ?>">
							
								<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_thumbnail', true), $image_width, $image_height, true); ?>
								<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />
							
							</a>
						
						</div>
					
					<?php } else { ?>
					
						<a href="<?php the_permalink(); ?>" class="related-image"></a>
						
					<?php } ?>
					
					<div class="related-text">
					
					<h5><a href="<?php the_permalink(); ?>"><?php echo related_title(get_the_title());?></a></h5>
					
					<div class="related-date"><?php the_time('d, F Y'); ?></div>
					
					</div>
					
					<div class="clear"></div>	
					<div class="divider"></div>
				
				</div>
				
			<?php endwhile; ?>
		
		</div>
		
		<div class="clear"></div>

<?php 

	$output_string = ob_get_contents();
	ob_end_clean(); 
	
	} wp_reset_query();
		
	return $output_string;

}

add_shortcode("related_posts", "ghostpool_related_posts");

?>