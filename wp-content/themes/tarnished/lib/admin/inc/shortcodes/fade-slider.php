<?php 

//*************************** Fade Slider ***************************//

function ghostpool_fade_slider($atts, $content = null) {
    extract(shortcode_atts(array(
		'name' => 'fadeslider',
        'cats' => '',
        'slides' => '-1',
        'effect' => 'scrollHorz',
        'timeout' => '6',
        'nav' => '1',
        'width' => '950',
        'height' => '450',      
        'align' => 'alignnone',
        'pause_button' => 'false'
    ), $atts));

	require(ghostpool_inc . 'options.php');
	global $wp_query, $post;
 
	// Remove spaces from slider name
	$slider_name = preg_replace('/[^a-zA-Z0-9]/', '', $name);

	// Slider Query	
	if($cats) {
		
		$args=array(
		'post_type' => 'slide',
		'posts_per_page' => $slides,
		'tax_query' => array('relation' => 'OR', array('taxonomy' => 'slide_categories', 'terms' => explode(',', $cats), 'field' => 'id'))
		);
	
	} else {
	
		$args=array(
		'post_type' => 'slide',
		'posts_per_page' => $slides,
		);
	
	}
	
	$featured_query = new wp_query($args);
	
	ob_start(); ?>
			
	<?php if ($featured_query->have_posts()) : ?>
					
	<!--Begin Slider Wrapper-->
	<div class="slider-wrapper <?php echo $align; ?> <?php if($nav == "1") { ?>nav-type-1<?php } elseif($nav == "2") { ?>nav-type-2<?php } elseif($nav == "3") { ?>nav-type-3<?php } ?>" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">		

		<!--Begin Pause Button-->					
		<?php if($pause_button == "true") { ?>
			<span id="slider-controls">
				<a href="#" class="rotation"><span class="rotation-button pause-button">&#x2590;&#x2590;</span></a>	
			</span>
		<?php } ?>
		<!--End Pause Button-->
			
		<!--Begin Slider-->
		<div id="<?php echo $slider_name; ?>" class="slider" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
		
			<?php while ($featured_query->have_posts()) : $featured_query->the_post(); 	$slide_counter++;
			 
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
		
				<!--Begin Slide-->
				<div class="slide" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">

					<?php
					
					// Default Image Width
					$image_width = $width;
					
					// Caption Type
					if(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Left Frame") {
					$caption_type = "caption-left";
					} elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Right Frame") {
					$caption_type = "caption-right";
					} elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Top Left Overlay") {
					$caption_type = "caption-topleft";
					} elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Top Right Overlay") {
					$caption_type = "caption-topright";
					} elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Bottom Left Overlay") {
					$caption_type = "caption-bottomleft ";
					} elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Bottom Right Overlay") {
					$caption_type = "caption-bottomright";
					}
				
					if(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Left Frame" OR get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) == "Right Frame") { 
					
					// Frame Dimensions
					$image_width = round($width/1.5);
					$frame_width_text = $width - $image_width - 42;
					$frame_height = $height - 42;
					
					?>
					
						<!--Begin Caption Frame-->
						<div class="caption-frame <?php echo $caption_type; ?> <?php if(get_post_meta($post->ID, 'ghostpool_slide_caption_style', true) == "Light") { ?>caption-light<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_style', true) == "Dark") { ?>caption-dark<?php } ?>" style="width: <?php echo $frame_width_text; ?>px; height: <?php echo $frame_height; ?>px;"><?php if(!get_post_meta($post->ID, 'ghostpool_hide_slide_title', true)) { ?><h2><?php the_title(); ?></h2><?php } ?><?php do_shortcode(the_content()); ?></div>
						<!--End Caption Frame-->
					
					<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_type', true) != "None") { ?>
					
						<!--Begin Caption Overlay-->
						<div class="caption-overlay <?php echo $caption_type; ?> <?php if(get_post_meta($post->ID, 'ghostpool_slide_caption_style', true) == "Light") { ?>caption-light<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_caption_style', true) == "Dark") { ?>caption-dark<?php } ?> <?php if(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Image" OR get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Video") { ?>lightbox<?php } ?>">
							<?php if(!get_post_meta($post->ID, 'ghostpool_hide_slide_title', true)) { ?>
								<h2><?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?><a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>"><?php the_title(); ?></a><?php } else { ?><?php the_title(); ?><?php } ?></h2>					
							<?php } ?>
						</div>
						<!--End Caption Overlay-->
						
					<?php } ?>
					
					<!--Begin Video-->
					
					<?php if(get_post_meta($post->ID, 'ghostpool_slide_video', true) OR get_post_meta($post->ID, 'ghostpool_webm_mp4_slide_video', true) OR get_post_meta($post->ID, 'ghostpool_ogg_slide_video', true)) {
					
					// Detect MSIE
					$MSIE = (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') !== FALSE);
					
					?>
			
						<div class="slide-video" style="width: <?php echo $image_width; ?>px; height: <?php echo $height; ?>px;">
						
							<?php
							
							// Detect Vimeo
							$vimeo = strpos(get_post_meta($post->ID, 'ghostpool_slide_video', true),"vimeo.com");
							$vimeoid = trim(get_post_meta($post->ID, 'ghostpool_slide_video', true),'http://vimeo.com/'); 
														
							if($vimeo == true) { // Vimeo ?>
								
								<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo $image_width; ?>" height="<?php echo $height; ?>">
									<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid; ?>&amp;autoplay=<?php if($MSIE && $slide_counter != "1") { ?>0<?php } else { ?><?php if(get_post_meta($post->ID, 'ghostpool_slide_autostart_video', true)) { ?>1<?php } else { ?>0<?php } ?><?php } ?>" />
									<param name="wmode" value="transparent" />
									<param name="allowfullscreen" value="true" />
									<param name="allowscriptacess" value="always" />
									<!--[if !IE]>-->                
									<object type="application/x-shockwave-flash" data="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid; ?>&amp;autoplay=<?php if($MSIE && $slide_counter != "1") { ?>0<?php } else { ?><?php if(get_post_meta($post->ID, 'ghostpool_slide_autostart_video', true)) { ?>1<?php } else { ?>0<?php } ?><?php } ?>" width="<?php echo $image_width; ?>" height="<?php echo $height; ?>">
									<param name="wmode" value="transparent" />
									<param name="allowfullscreen" value="true" />
									<param name="allowscriptacess" value="always" />				
									<!--<![endif]-->
										<iframe src="http://player.vimeo.com/video/<?php echo $vimeoid; ?>?byline=0&amp;portrait=0&amp;autoplay=0" width="<?php echo $image_width; ?>" height="<?php echo $height; ?>" frameborder="0"></iframe>
									<!--[if !IE]>-->
									</object>
									<!--<![endif]-->
								</object>
							
							<?php } else { // JW Player ?>
							
								<?php if((strpos(get_post_meta($post->ID, 'ghostpool_slide_video', true),"youtube.com") && get_post_meta($post->ID, 'ghostpool_slide_video_priority', true) == "Flash")) { ?>
								
									<div id="<?php echo $slider_name; ?>-video-<?php the_ID(); ?>"></div>

								<?php } else { ?>
								
									<video id="<?php echo $slider_name; ?>-video-<?php the_ID(); ?>" width="<?php echo $image_width; ?>" height="<?php echo $height; ?>" controls="controls" preload>
									
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
										<?php if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_slide_image', true)) { ?>image: "<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_slide_image', true), $image_width, $height, true); echo $image[url]; ?>",<?php } ?>
										icons: "true",
										autostart: "<?php if($MSIE && $slide_counter != '1') { ?>false<?php } else {?><?php if(get_post_meta($post->ID, 'ghostpool_slide_autostart_video', true)) { ?>true<?php } else { ?>false<?php } ?><?php } ?>",
										controlbar: "<?php if(get_post_meta($post->ID, 'ghostpool_slide_video_controls', true) == 'Over') { ?>over<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_video_controls', true) == 'Bottom') { ?>bottom<?php } else { ?>none<?php } ?>",
										screencolor: "black",	
										height: <?php echo $height; ?>,
										width: <?php echo $image_width; ?>,
										skin: "<?php bloginfo('template_directory'); ?>/lib/scripts/mediaplayer/fs39/fs39.xml",
										flashplayer: "<?php bloginfo("template_directory"); ?>/lib/scripts/mediaplayer/player.swf"									
									});
								</script>
							
							<?php } ?>

						</div>
						
						<!--End Video-->

					<?php } else { ?>
					
						<!--Begin Image-->

						<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_slide_image', true), 9999, 9999, true); ?>

						<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?>

							<?php if(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Page URL") { ?>
								
								<a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>">
					
							<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Image") { ?>					
								
								<a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>" rel="prettyPhoto[<?php echo $slider_name; ?>-slider]">
								
							<?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Video") { ?>	
								
								<a href="file=<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>&image=<?php echo get_image_path(get_post_meta($post->ID, 'ghostpool_slide_image', true)); ?>" rel="prettyPhoto[<?php echo $slider_name; ?>-slider]">
							
							<?php } ?>
						
						<?php } ?>	

							<?php if(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Image") { ?><span class="hover-image" style="width: <?php echo $image_width; ?>px; height: <?php echo $height; ?>px;"></span><?php } elseif(get_post_meta($post->ID, 'ghostpool_slide_link_type', true) == "Lightbox Video") { ?><span class="hover-video" style="width: <?php echo $image_width; ?>px; height: <?php echo $height; ?>px;"></span><?php } ?>
								
							<?php if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_slide_image', true)) { ?>
								<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_slide_image', true), $image_width, $height, true); ?>
								<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />
							<?php } ?>
												
						<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?></a><?php } ?>
					
						<!--End Image-->
					
					<?php } ?>			

				</div>
				<!--End Slide-->
			
				<?php $meta_timeout = get_post_meta($post->ID, 'ghostpool_slide_timeout', true);
				if($meta_timeout) {
				$timeout_array = $timeout_array . $meta_timeout .","; 
				} else {
				$timeout_array = $timeout_array . $timeout.",";
				} ?>         

			<?php endwhile; wp_reset_query(); ?>
		
			</div>
			<!--End Slider-->
	
			<!--Begin Slider Nav-->
			<?php if($nav != "0") { ?>
				
				<div id="<?php echo $slider_name; ?>-slider-nav" class="slider-nav-wrapper <?php if($nav == "1") { ?>nav-type-1<?php } elseif($nav == "2") { ?>nav-type-2<?php } elseif($nav == "3") { ?>nav-type-3<?php } ?>">

					<div class="slider-nav-left"></div>		
					
					<div class="slide-prev" id="<?php echo $slider_name; ?>-prev"></div>

					<div class="slider-nav-overflow" style="width: <?php echo $width - 60; ?>px;">

						<span class="slider-nav">
							
						<?php while ($featured_query->have_posts()) : $featured_query->the_post(); global $wp_query; $post->ID = $GLOBALS['post']->ID; ?>
							
							<span class="slider-button">
							<?php if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_slide_image', true)) { ?>
								<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_slide_image', true), 109, 54, true); ?>
								<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" style="width: <?php echo $image['width']; ?>px; height: <?php echo $image['height']; ?>px;" alt="" class="slider-image" />
							<?php } ?>
							</span>
							
						<?php endwhile; wp_reset_query(); ?>
						
						</span>					
					
					</div>
					
					<div class="slide-next" id="<?php echo $slider_name; ?>-next"></div>		
					
					<div class="slider-nav-right"></div>
					
				</div>
			
			<?php } ?>
			<!--End Slider Nav-->
		
		</div>
		<!--End Slider Wrapper-->

	<?php else : ?>
		
		<div class="columns one last separate"><div>Oops, you haven't set your slider up correctly. Make sure you have created some slides from Slides > Add New and slide categories from Slides > Slide Categories.</div></div>
		
	<?php endif; wp_reset_query(); ?>
				
	<script>
	jQuery(document).ready(function(){
        // Initialize variables for tracking reserves
        var reservesInit = 0,
            pager = {},
            anchors = [],
            maxvis = 0;
		
        jQuery("#<?php echo $slider_name; ?>") 
		.cycle({ 
			fx: "<?php echo $effect; ?>",
			<?php if($timeout == "0") { ?>timeout: <?php echo $timeout; ?><?php } else { ?>timeoutFn: slideTimeout<?php echo $slider_name; ?><?php } ?>,
			speed: 1000,
			pause: 1,
			cleartype: true,
			cleartypeNoBg: true,		
			prev: "#<?php echo $slider_name; ?>-prev", 
			next: "#<?php echo $slider_name; ?>-next",
			pager: "#<?php echo $slider_name; ?>-slider-nav .slider-nav",
			pagerAnchorBuilder: function(idx, slide) {return "#<?php echo $slider_name; ?>-slider-nav .slider-nav span:eq(" + idx + ")";},
            <?php if($nav == "1") { ?>before: onBefore,<?php } ?>
            maxvis: <?php echo round((($width - 60) / 132), 0); ?>
		});
	
		// Toggle Slider Controls
		jQuery(".rotation").toggle(
			function(){
				jQuery('#<?php echo $slider_name; ?>').cycle('pause'); 
				jQuery(".rotation-button").replaceWith('<span class="rotation-button">&#9658;</span>');
			},
			function () {
				jQuery('#<?php echo $slider_name; ?>').cycle('resume'); 
				jQuery(".rotation-button").replaceWith('<span class="rotation-button pause-button">&#x2590;&#x2590;</span>');
			}
		);	
		
		// Pause Slider When Videos Clicked
		jQuery(".pause").click(function(){
			jQuery('#slider').cycle('pause');
		});	
        
        function onBefore(curr, next, opts) {
        
            // this is only run once to setup the reserves
            if (reservesInit === 0) {
                pager = jQuery(opts.pager),
                anchors = pager.children(),
                maxvis = opts.maxvis;
                    
                anchors.each(function(i, el) {
                    if (i >= maxvis) {
                        jQuery(el).addClass('resR');
                    }
                });;
                
                reservesInit = 1;
            }
            
            // in case there are more slides than can fit in 5000px
            if (pager.width() < anchors.length * anchors.eq(0).outerWidth(0)) {
                pager.css('width', anchors.length * anchors.eq(0).outerWidth(0));
            }
            
            var currSlide = opts.currSlide,
                lastSlide = opts.lastSlide,
                nextSlide = opts.nextSlide;
                
            if (nextSlide === 0) {
                // reset all the anchors and reserves
                anchors.each(function(i, el) {
                    var jObj = jQuery(el);
                    
                    if (jObj.hasClass('resL')) {
                        jObj.removeClass('resL');
                    }
                    
                    if (i >= maxvis) {
                        jObj.addClass('resR');
                    }
                });
                
                // slide the pager back into default position
                pager.animate({
                    left: 0
                }, 'normal');
                
            } else if (nextSlide === anchors.length - 1) {
                // set anchors and reserves to their states for the last anchor
                anchors.each(function(i, el) {
                    var jObj = jQuery(el);
                    
                    if (jObj.hasClass('resR')) {
                        jObj.removeClass('resR');
                    }
                    
                    if (i <= nextSlide - maxvis) {
                        jObj.addClass('resL');
                    }
                });
                
                // slide the pager to display the last anchor
                pager.animate({
                    left: (anchors.length - maxvis) * anchors.eq(0).outerWidth(true) * -1
                }, 'normal');
                
            } else {
                if (currSlide < nextSlide) { // moving right (positive)
                    if (anchors.eq(nextSlide + 1).hasClass('resR')) {
                        anchors.eq(nextSlide + 1).removeClass('resR');
                        anchors.eq(nextSlide + 1 - maxvis).addClass('resL');
                        
                        if (nextSlide !== anchors.length - 1) {
                            pager.animate({
                                left: '-=' + anchors.eq(nextSlide + 1 - maxvis).outerWidth(true)
                            }, 'normal');
                        }
                    };
                    
                } else if (currSlide > nextSlide) { // moving left (negative)
                    if (anchors.eq(nextSlide - 1).hasClass('resL')) {
                        anchors.eq(nextSlide - 1).removeClass('resL');
                        anchors.eq(nextSlide - 1 + maxvis).addClass('resR');
                        
                        if (nextSlide !== 0) {
                            pager.animate({
                                left: '+=' + anchors.eq(nextSlide - 1 + maxvis).outerWidth(true)
                            }, 'normal');
                        }
                    }
                }
            }
        }
		
	});

	// Timeouts per slide (in seconds) 
	var posttimeouts<?php echo $slider_name; ?> = [<?php echo $timeout_array; ?>]; 
	function slideTimeout<?php echo $slider_name; ?>(currElement, nextElement, opts, isForward) { 
	var index = opts.currSlide; 
	return posttimeouts<?php echo $slider_name; ?>[index] * 1000; 
	} 
	
	</script> 
	
<?php

$output_string = ob_get_contents();
ob_end_clean(); 

return $output_string;

}
add_shortcode('fade_slider', 'ghostpool_fade_slider');

?>