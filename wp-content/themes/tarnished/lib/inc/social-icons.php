<div id="social">

	<?php if($theme_rss_button == "1") {} else { ?><a class="rss" href="<?php if($theme_rss) { ?><?php echo($theme_rss); ?><?php } else { ?><?php bloginfo('rss2_url'); ?><?php } ?>"></a><?php } ?>

	<?php if($theme_email) { ?><a class="gmail" href="mailto:<?php echo($theme_email); ?>"></a><?php } ?>
	
	<?php if($theme_twitter) { ?><a class="twit" href="<?php echo $theme_twitter; ?>"></a><?php } ?>
	
	<?php if($theme_facebook) { ?><a class="fb" href="<?php echo $theme_facebook; ?>"></a><?php } ?>
	
	<?php if($theme_myspace) { ?><a class="ms" href="<?php echo $theme_myspace; ?>"></a><?php } ?>
	
	<?php if($theme_digg) { ?><a href="<?php echo $theme_digg; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/social/digg.png" alt="" /></a><?php } ?>
	
	<?php if($theme_flickr) { ?><a href="<?php echo $theme_flickr; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/social/flickr-2.png" alt="" /></a><?php } ?>

	<?php if($theme_delicious) { ?><a href="<?php echo $theme_delicious; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/social/delicious.png" alt="" /></a><?php } ?>

	<?php if($theme_linkedin) { ?><a href="<?php echo $theme_linkedin; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/social/linkedin.png" alt="" /></a><?php } ?>
	
	<?php if($theme_youtube) { ?><a href="<?php echo $theme_youtube; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/social/youtube.png" alt="" /></a><?php } ?>

	<?php if($theme_vimeo) { ?><a href="<?php echo $theme_vimeo; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/social/vimeo.png" alt="" /></a><?php } ?>
    
    <a class="sc" href="https://soundcloud.com/mixjunkies"></a>
    <a class="gog" href="https://plus.google.com/104689262686977679818" rel="publisher"></a>
    
	
</div> 