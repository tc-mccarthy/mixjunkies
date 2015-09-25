<?php if($type == 'grid') { ?><div style="border:0px solid #333333;<?php if($col_height!=''){ ?>height: <?php echo $col_height; ?>px;<?php } ?>"><?php } ?>

	<!--Begin Image-->
	
	<?php
	
	$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); $attachments = get_children($args); 
	
	if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
		
		<div class="portfolio-thumbnail <?php echo $shadow; ?>" style="background-position: center <?php echo ($image_height - 16); ?>px;">
		
			<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image" OR get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?>
				<a href="<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?>file=<?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?>&amp;image=<?php echo get_post_meta($post->ID, 'ghostpool_thumbnail', true); ?><?php } else { ?><?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?><?php } ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]">
			<?php } else { ?>
				<a href="<?php if(get_post_meta($post->ID, 'ghostpool_custom_url', true)) { echo get_post_meta($post->ID, 'ghostpool_custom_url', true);  } else {  echo get_permalink( $post->ID ); } ?>">
			<?php } ?>
					
			<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image") { ?><span class="hover-image"></span><?php } elseif(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?><span class="hover-video"></span><?php } ?>
			
			<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
			
				<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_thumbnail', true), $image_width, $image_height, true); ?>
					<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />
                    
  
							
			<?php } elseif($attachments) { foreach ($attachments as $attachment) { ?>
					
				<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_thumbnail', true), $image_width, $image_height, true); ?>
					<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />

			<?php }} ?>
			
			</a>
	
		</div>
		
		<?php if($type != 'large') { ?><div class="clear"></div><?php } ?>
	
	<?php } ?>
	
	<!--End Image-->

	<?php $args = array('post_type' => 'attachment', 'post_parent' => $post->ID, 'numberposts' => -1, 'orderby' => menu_order, 'order' => ASC); $attachments = get_children($args); if($attachments) { foreach ($attachments as $attachment) { ?><a href="<?php if(get_post_meta($attachment->ID, '_ghostpool_gallery_video_url', true)) { echo get_post_meta($attachment->ID, '_ghostpool_gallery_video_url', true); } else { echo wp_get_attachment_url($attachment->ID); } ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]" title="<?php echo ($attachment->post_content); ?>" style="display: none"><img src="" alt="<?php echo ($attachment->post_title); ?>"></a><?php }} ?>
	
	<?php if(esc_attr($title) == 'true') { ?><h2><?php if($title_link == "true") { ?><a href="<?php echo get_permalink( $post->ID ); ?>"><?php } ?><?php echo $post->post_title; ?><?php if($title_link == "true") { ?></a><?php } ?></h2><?php } ?>
	
	<?php if(esc_attr($excerpt_length) == '0') {} elseif(esc_attr($excerpt_length) != '0') { ?>
		<div class="portfolio-text">
			<p><?php echo excerpt2($excerpt_length, $post); ?> <?php if($read_more == "true") { ?><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo gp_read_more; ?> &rsaquo;&rsaquo;</a><?php } ?></p>
		</div>
	<?php } ?>

<?php if($type == 'grid') { ?></div><?php } ?>