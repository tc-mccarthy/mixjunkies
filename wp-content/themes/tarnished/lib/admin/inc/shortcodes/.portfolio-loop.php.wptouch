<?php if($type == 'grid') { ?><div style="height: <?php echo $col_height; ?>px;"><?php } ?>

	<!--Begin Image-->
	
	<?php
	
	$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); $attachments = get_children($args); 
	
	if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
		
		<div class="portfolio-thumbnail">
		
			<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image") { ?>			
				<a href="<?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php the_title(); ?>">			
			<?php } elseif(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?>
				<a href="file=<?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?>&amp;image=<?php echo get_image_path(get_post_meta($post->ID, 'ghostpool_thumbnail', true)); ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php the_title(); ?>">
			<?php } else { ?>
				<a href="<?php if(get_post_meta($post->ID, 'ghostpool_custom_url', true)) { ?><?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?><?php  } else { ?><?php the_permalink(); ?><?php } ?>">	
			<?php } ?>
					
				<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image") { ?><span class="hover-image"></span><?php } elseif(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?><span class="hover-video"></span><?php } ?>
				
					<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_thumbnail', true), $image_width, $image_height, true); ?>
					<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />
			
			</a>
	
		</div>
		
		<?php if($type != 'large') { ?><div class="clear"></div><?php } ?>
	
	<?php } ?>
	
	<!--End Image-->

	<?php $args = array('post_type' => 'attachment', 'post_parent' => $post->ID, 'numberposts' => -1, 'orderby' => menu_order, 'order' => ASC); $attachments = get_children($args); if($attachments) { foreach ($attachments as $attachment) {
	
	if($attachment->menu_order == 1) { ?>
	
		<a href="<?php if(get_post_meta($attachment->ID, '_ghostpool_gallery_video_url', true)) { ?>file=<?php echo get_post_meta($attachment->ID, '_ghostpool_gallery_video_url', true); ?><?php } else { ?><?php echo get_image_path(wp_get_attachment_url($attachment->ID)); ?><?php } ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo $attachment->post_content; ?>" style="display: none"><img src="" alt="<?php echo $attachment->post_title; ?>"></a>
	
	<?php }}} ?>
	
	<?php if(esc_attr($title) == 'true') { ?><h2><?php if($title_link == "true") { ?><a href="<?php the_permalink(); ?>"><?php } ?><?php the_title(); ?><?php if($title_link == "true") { ?></a><?php } ?></h2><?php } ?>
	
	<?php if(esc_attr($excerpt_length) == '0') {} elseif(esc_attr($excerpt_length) != '0') { ?>
		<div class="portfolio-text">
			<p><?php echo excerpt($excerpt_length); ?> <?php if($read_more == "true") { ?><a href="<?php the_permalink(); ?>"><?php echo gp_read_more; ?> &rsaquo;&rsaquo;</a><?php } ?></p>
		</div>
	<?php } ?>

<?php if($type == 'grid') { ?></div><?php } ?>