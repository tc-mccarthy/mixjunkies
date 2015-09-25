<?php require(ghostpool_inc . 'options.php'); ?>
<?php if((is_singular() && get_post_meta($post->ID, 'ghostpool_layout_individual', true) == "Fullwidth") OR ($theme_layout == "Fullwidth" && (is_singular() && get_post_meta($post->ID, 'ghostpool_layout_individual', true) == "Default"))) {} else { ?>

<div id="sidebar">
  <?php /*?><a class="cal" href="http://www.mixjunkies.com/events/electronic-dance-music-events/"><span class="icon"></span><strong>EVENT CALENDAR</strong>
<i>Plan your weekend with the hottest events.</i></a><?php */?>
  <div class="widget">
    <div class="textwidget">
      <div class="ad">
      <?php echo do_shortcode("[sam id=1 codes='false']");?>
      </div>
    </div>
  </div>
  <!-- END WIDGET -->

    
  <?php
		$key = 'facebook_url';
		$themeta = get_post_meta($post->ID, $key, TRUE);
		if($themeta != '') {

		echo '<div class="widget"><h3>Latest On Facebook</h3><div id="artistLike"><div class="fb-like-box" data-href="';
	    echo get_post_meta($post->ID, "facebook_url", true);
		echo '" data-width="292" data-show-faces="true" data-stream="true" data-header="false"></div></div></div>';
		}
	?>
    <?php
		$key = 'instagram_name';
		$themeta = get_post_meta($post->ID, $key, TRUE);
		if($themeta != '') {

		echo '<div class="widget"><h3>Latest On Instagram</h3><iframe src="http://widget.stagram.com/in/';
	    echo get_post_meta($post->ID, "instagram_name", true);
		echo '/?s=86&w=3&h=3&b=1&p=10" allowtransparency="true" frameborder="0" scrolling="no" style="border:none;overflow:hidden;width:310px; height: 320px" ></iframe><div class="ifollow"><iframe src="http://widget.stagram.com/follow/';
		echo get_post_meta($post->ID, "instagram_name", true);
		echo '" style="height:27px;" frameborder="0"></iframe></div></div>';
		}
	?>
      <?php
		$key = 'twitter_name';
		$themeta = get_post_meta($post->ID, $key, TRUE);
		if($themeta != '') {

		echo ' <div class="tweets">';
		echo '<a class="twitter-timeline" href="https://twitter.com/';
	    echo get_post_meta($post->ID, "twitter_name", true);
		echo '" data-widget-id="345360229329952768" data-screen-name="',get_post_meta($post->ID, "twitter_name", true),'">Tweets by @';
		echo get_post_meta($post->ID, "twitter_name", true);
		echo '</a></div>';

		}
	?>
    <?php if(is_singular() && get_post_meta($post->ID, 'ghostpool_sidebar', true)) { dynamic_sidebar(get_post_meta($post->ID, 'ghostpool_sidebar', true)); } else { dynamic_sidebar('Default Sidebar'); } ?>
  <div class="widget">
    <div class="textwidget">
      <div class="ad"> 
      <?php //echo do_shortcode("[sam id=2 codes='false']");?>
      </div>

    </div>
    </div>
</div>
<?php } ?>
