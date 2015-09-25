<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php require('lib/inc/page-styling.php'); ?>	

	<div id="content-wrapper" class="post-<?php the_ID(); ?> <?php echo($layout); ?>">

		<?php if(get_post_meta($post->ID, 'ghostpool_top_content', true)) { ?>
		
			<div id="top-content">
				<?php echo stripslashes(do_shortcode(get_post_meta($post->ID, 'ghostpool_top_content', true))); ?>
				<div class="clear"></div>	
			</div>

			<div class="clear"></div>
		
		<?php } ?>
                        <div id="theBar">
                        <div id="moreOf"><strong>MORE OF:</strong> <span><?php the_category(' / '); ?></span><div class="carrot"></div></div>   
                            
                            <div class="simpleShare">
                                <strong>SPREAD THE <i></i></strong>
                                    <span></span>
                              <a href="#" class="fb">Facebook Share</a>
                              <a href="#" class="twit" data-mention="@Mixjunkies">Twitter Share</a>
                              <a href="#" class="gog">Google</a>
                              <a href="#" class="pin">Pin It</a>
                              </div>
                        </div>
		<div id="main-content" class="single-wrapper">

			<?php if(!get_post_meta($post->ID, 'ghostpool_page_title', true)) { ?>
				<?php if(get_post_meta($post->ID, 'ghostpool_reduce_title_size', true)) { ?><h2 class="page-title"><?php the_title(); ?></h2><?php } else { ?><h1 class="page-title"><?php the_title(); ?></h1><?php } ?>
			<?php } ?>			
			
			<div class="clear"></div>
			
			<div class="single-wrapper">
		
				<div class="byline"><span class="post-date"><?php the_time('d, F Y'); ?></span><?php if(!get_post_meta($post->ID, 'ghostpool_page_title', true)) { ?><span class="post-creator"><?php echo gp_by; ?> <?php the_author_link(); ?></span></div>
			    				<?php
					if(function_exists('wpv_voting_display_vote'))
					wpv_voting_display_vote(get_the_ID());
					?>
                 <?php if(function_exists('the_ratings')) { the_ratings(); } ?> 
				
				
				<div class="clear"></div><?php } ?>
			
				<?php the_content(); ?>
				
				<?php wp_link_pages('before=<div class="clear"></div><div class="wp-pagenavi post-navi">&pagelink=<span>%</span>&after=</div>'); ?>		
				
				<?php the_tags('<p class="hclear">Tags: ', ', ', '</p>'); ?>
                                
                                    <div id="sBar" class="simpleShare">
                                        <strong>LIKE IT? SHARE IT <i></i></strong>
                                            <span></span>
                                      <a href="#" class="fb">Facebook Share</a>
                                      <a href="#" class="twit" data-mention="@Mixjunkies">Twitter Share</a>
                                      <a href="#" class="gog">Google</a>
                                      <a href="#" class="pin">Pin It</a>
                                      </div>
                                
				
				<?php if($theme_author_info == "0") { echo do_shortcode('[author]'); } ?>	
				
				<?php  if($theme_related_posts == "0") { echo do_shortcode('[related_posts limit="'.$theme_related_limit.'"]'); } ?>
				<?php /*<div id="zrelate"><?php zemanta_related_posts()?></div> */ ?>
				<?php comments_template(); ?>
			
			</div>
			
		</div>
	
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
		
	</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>