<!--Begin Caption-->

<?php if(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "None") {} else { ?>
	
	<div class="caption-outer <?php if(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Top") { ?>caption-top<?php } else { ?>caption-bottom<?php } ?> <?php if(get_post_meta($post->ID, 'ghostpool_slide_caption_style', true) == "Light") { ?>caption-light<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_style', true) == "Dark") { ?>caption-dark<?php } ?> <?php if(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Image" OR get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Video") { ?>lightbox<?php } ?>" style="width: <?php echo $caption_width; ?>px;">
		<div class="caption-inner">
			<?php if(get_post_meta($post->ID, 'ghostpool_hide_slide_title', true)) {} else { ?><h2><?php the_title(); ?></h2><?php } ?>
			<?php the_content(); ?>
		</div>
	</div>
	
<?php } ?>

<!--End Caption-->

<?php if(get_post_meta($post->ID, 'ghostpool_slide_video', true) OR get_post_meta($post->ID, 'ghostpool_webm_mp4_slide_video', true) OR get_post_meta($post->ID, 'ghostpool_ogg_slide_video', true)) { ?>

	<!--Begin Video-->

	<div class="slide-video" style="width: <?php echo $image_max_width; ?>px; height: <?php echo $image_max_height; ?>px;">

		<?php 
		
		// Detect MSIE
		$MSIE = (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') !== FALSE);
		
		// Vimeo
	
		$vimeo = strpos(get_post_meta($post->ID, 'ghostpool_slide_video', true),"vimeo.com");
		
		if($vimeo == true) {
		
		$vimeoid = trim(get_post_meta($post->ID, 'ghostpool_slide_video', true),'http://vimeo.com/'); ?>

			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo $image_max_width; ?>" height="<?php echo $image_max_height; ?>">
				<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid; ?>&amp;autoplay=<?php if(get_post_meta($post->ID, 'ghostpool_slide_autostart_video', true)) { ?>1<?php } else { ?>0<?php } ?>" />
				<param name="wmode" value="transparent" />
				<param name="allowfullscreen" value="true" />
				<param name="allowscriptacess" value="always" />
				<!--[if !IE]>-->                
				<object type="application/x-shockwave-flash" data="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid; ?>&amp;autoplay=<?php if(get_post_meta($post->ID, 'ghostpool_slide_autostart_video', true)) { ?>1<?php } else { ?>0<?php } ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_max_height; ?>">
				<param name="wmode" value="transparent" />
				<param name="allowfullscreen" value="true" />
				<param name="allowscriptacess" value="always" />				
				<!--<![endif]-->
					<iframe src="http://player.vimeo.com/video/<?php echo $vimeoid; ?>?byline=0&amp;portrait=0&amp;autoplay=<?php if(get_post_meta($post->ID, 'ghostpool_slide_autostart_video', true)) { ?>1<?php } else { ?>0<?php } ?>" width="<?php echo $image_max_width; ?>" height="<?php echo $height; ?>" frameborder="0"></iframe>
				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>
	
		<?php } else { // JW Player ?>
		
			<?php if(strpos(get_post_meta($post->ID, 'ghostpool_slide_video', true),"youtube.com")) { ?>
			
				<div id="<?php echo $slider_name; ?>-video-<?php the_ID(); ?>"></div>
			
			<?php } else { ?>
	
				<video id="<?php echo $slider_name; ?>-video-<?php the_ID(); ?>" width="<?php echo $image_max_width; ?>" height="<?php echo $image_max_height; ?>" controls="controls" preload>
				
					<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false OR strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) { ?>
						<source src="<?php echo get_post_meta($post->ID, 'ghostpool_webm_mp4_slide_video', true); ?>" type="video/mp4" />
						<source src="<?php echo get_post_meta($post->ID, 'ghostpool_webm_mp4_slide_video', true); ?>" type="video/webm" />
					<?php } else { ?>	
						<source src="<?php echo get_post_meta($post->ID, 'ghostpool_ogg_slide_video', true); ?>" type="video/ogg" />
					<?php } ?>
				
				</video>
		
			<?php } ?>
			
			<script>
	
				jwplayer("<?php echo $slider_name; ?>-video-<?php the_ID(); ?>").setup({
					<?php if($MSIE OR get_post_meta($post->ID, 'ghostpool_slide_video_priority', true) == "Flash") { ?>file: "<?php echo get_post_meta($post->ID, 'ghostpool_slide_video', true); ?>",<?php } ?>
					<?php if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_slide_image', true)) { ?>image: "<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_slide_image', true), $image_max_width, $image_max_height, true); echo $image[url]; ?>",<?php } ?>
					icons: "true",
					autostart: "<?php if(get_post_meta($post->ID, 'ghostpool_slide_autostart_video', true)) { ?>true<?php } else { ?>false<?php } ?>",
					controlbar: "<?php if(get_post_meta($post->ID, 'ghostpool_slide_video_controls', true) == 'Over') { ?>over<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_video_controls', true) == 'Bottom') { ?>bottom<?php } else { ?>none<?php } ?>",
					screencolor: "black",
					height: <?php echo $image_max_height; ?>,
					width: <?php echo $image_max_width; ?>,
					skin: "<?php bloginfo('template_directory'); ?>/lib/scripts/mediaplayer/fs39/fs39.xml",
					flashplayer: "<?php bloginfo('template_directory'); ?>/lib/scripts/mediaplayer/player.swf"										
				});
			
			</script>
		
		<?php } ?> 

	</div>
	<!-- End Video-->

<?php } else { ?>

	<!--Being Image-->
	
	<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?>
	
		<?php if(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Page URL") { ?>
			
			<a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>">
	
		<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Image") { ?>					
			
			<a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>" rel="prettyPhoto[<?php echo $slider_name; ?>-slider]">
			
		<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Video") { ?>	
			
			<a href="file=<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>&image=<?php echo get_image_path(get_post_meta($post->ID, 'ghostpool_slide_image', true)); ?>" rel="prettyPhoto[<?php echo $slider_name; ?>-slider]">
		
		<?php } ?>
	
	<?php } ?>	
		
		<?php if(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Image") { ?><span class="hover-image" style="width: <?php echo $image_max_width; ?>px; height: <?php echo $image_max_height; ?>px;"></span><?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Video") { ?><span class="hover-video" style="width: <?php echo $image_max_width; ?>px; height: <?php echo $image_max_height; ?>px;"></span><?php } ?>
									
		<?php if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_slide_image', true)) { ?>
			<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_slide_image', true), $image_max_width, $image_max_height, true); ?>
			<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />
		<?php } ?>
							
	<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?></a><?php } ?>

	<!--End Image-->

<?php } ?>