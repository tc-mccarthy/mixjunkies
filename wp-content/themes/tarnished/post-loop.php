<?php require('lib/inc/page-styling.php'); ?>	

<div id="content-wrapper" class="<?php echo($layout); ?>">
			
	<div id="main-content">

		<h1 class="page-title">
		<?php if(is_search()) { ?>
			<?php echo $wp_query->found_posts; ?> <?php echo gp_search_results; ?> "<?php echo esc_html($s); ?>"
		<?php } elseif(is_category()) { ?>
			<?php single_cat_title(); ?>
		<?php } elseif(is_tag()) { ?>
			<?php single_tag_title(); ?>
		<?php } elseif(is_author()) { ?>
			<?php wp_title(''); ?>'s Posts
		<?php } elseif(is_archive()) { ?>
			<?php echo gp_archives; ?> <?php wp_title(' / '); ?>			
		<?php } ?>
		</h1>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); $counter = $counter + 1;  ?>
		
			<div class="post<?php if($theme_preload == "1") { ?> preload<?php } ?><?php if($counter == 1) { ?> first<?php } ?>">
			
				<!--Begin Image-->
				<?php if(has_post_thumbnail() OR get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
				
					<div class="post-thumbnail<?php if($theme_content_wrap == "1") { ?> no-wrap<?php } ?>">

						<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image" OR get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?>
							<a href="<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?>file=<?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?>&amp;image=<?php echo get_image_path(get_post_meta($post->ID, 'ghostpool_thumbnail', true)); ?><?php } else { ?><?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?><?php } ?>" rel="prettyPhoto[gallery]">
						<?php } else { ?>
							<a href="<?php if(get_post_meta($post->ID, 'ghostpool_custom_url', true)) { ?><?php echo get_post_meta($post->ID, 'ghostpool_custom_url', true); ?><?php } else { ?><?php the_permalink(); ?><?php } ?>">
						<?php } ?>
		
						<?php if(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Image") { ?><span class="hover-image" style="width: <?php echo $theme_image_width; ?>px; height: <?php echo $theme_image_height; ?>px;"></span><?php } elseif(get_post_meta($post->ID, 'ghostpool_lightbox_type', true) == "Video") { ?><span class="hover-video" style="width: <?php echo $theme_image_width; ?>px; height: <?php echo $theme_image_height; ?>px;"></span><?php } ?>
						
							<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_thumbnail', true), $theme_image_width, $theme_image_height, true); ?>
							<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />			
						
						</a>
				
					</div>
				
				<?php } ?>
				<!--End Image-->
				
				<div class="post-text">
				
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
					<div class="post-creator"><?php echo gp_by; ?> <?php the_author_link(); ?></div>
					
					<p><?php echo excerpt($theme_excerpt_length); ?></p>
					
					<div class="post-meta">
					
						<span class="post-date"><?php the_time('d, F Y'); ?></span>
						
						<?php if($post->post_type == 'post') { ?><span class="post-cats"><?php the_category(' '); ?></span><?php } ?>
						
						<?php if('open' == $post->comment_status) { ?><span class="post-comments"><?php comments_popup_link(gp_no_comments, gp_one_comment, gp_more_comments, 'comments-link', ''); ?></span><?php } ?>
						
					</div>
									
				</div>
			
			</div>
			
			<div class="post-divider clear"></div>
			
		<?php endwhile; ?>
			
			<?php gp_pagination(); ?>

		<?php else : ?>	
	
			<div class="single-wrapper error-page">

				<h4><?php echo gp_search_error ?></h4>
			
				<div class="divider"></div>
				
				<h3><?php echo gp_search_site ?></h3>
				<?php /*?><?php get_search_form(); ?>	<?php */?>
                <script>
				  (function() {
					var cx = '015027420445388443858:--x-htw3-_c';
					var gcse = document.createElement('script');
					gcse.type = 'text/javascript';
					gcse.async = true;
					gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
						'//www.google.com/cse/cse.js?cx=' + cx;
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(gcse, s);
				  })();
				</script>
				<gcse:searchbox-only></gcse:searchbox-only>
			
			</div>
			
		<?php endif; ?>	

	</div>
		
	<?php if($theme_layout_other == "Fullwidth") {} else { ?><?php get_sidebar(); ?><?php } ?>
	
	<div class="clear"></div>
	
</div>