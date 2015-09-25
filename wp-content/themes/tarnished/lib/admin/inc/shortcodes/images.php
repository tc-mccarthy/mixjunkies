<?php

//*************************** Images ***************************//

function ghostpool_image($atts, $content = null) {
	extract(shortcode_atts(array(
		'url' => '#',
		'width' => '',
		'height' => '',
		'link' => '#',
		'align' => 'alignnone',
		'top' => '',
		'left' => '',
		'bottom' => '',
		'right' => '',
		'mtop' => '0',
		'mleft' => '0',
		'mbottom' => '0',
		'mright' => '0',
		'alt' => '',
		'title' => '',
		'lightbox' => 'none',
		'zoom' => '0',
		'preload' => 'false',
	),$atts));

	require(ghostpool_inc . 'options.php');

	// Image Positioning
	if(esc_attr(esc_attr($top) OR esc_attr($bottom) OR esc_attr($left) OR esc_attr($right)) != '') {
	$position = "position: absolute;";
	}
	if(esc_attr($top) != '') {
	$top_position = 'top:'.$top.'px;';
	}
	if(esc_attr($bottom) != '') {
	$bottom_position = 'bottom:'.$bottom.'px;';
	}
	if(esc_attr($left) != '') {
	$left_position = 'left:'.$left.'px;';
	}
	if(esc_attr($right) != '') {
	$right_position = 'right:'.$right.'px;';
	}
	
	// Lightbox
	if(esc_attr($lightbox) == "image") {
	$lightbox_hover = '<span class="hover-image" style="width: '.$width.'px; height: '.$height.'px;"></span>';
	$rel = "prettyPhoto[gallery]";
	} elseif(esc_attr($lightbox) == "video") {
	$lightbox_hover = '<span class="hover-video" style="width: '.$width.'px; height: '.$height.'px;"></span>';
	$rel = "prettyPhoto[gallery]";
	} else {
	$lightbox_hover = '';
	$rel = '';
	}
		
	// Image Link
	if(esc_attr($link) != '#') {
	if(esc_attr($lightbox) == "video") {
	$link1 = '<a href="file='.$link.'&image='.$url.'" title="'.$title.'" rel="'.$rel.'">';
	} else {
	$link1 = '<a href="'.$link.'" title="'.$title.'" rel="'.$rel.'">';
	}
	$link2 = '</a>';
	}
				
	// Image Cropping
	if($width != "" OR $height != "") {			
		$image = vt_resize('', $url, $width, $height, true);
		$url = $image[url];
		$cropping_class = "sc-crop";
	} else {
		if(!preg_match("/http:/", $url)) { $url = site_url().'/'.$url; }
		$cropping_class = "";
	}

	// Image Preloader
 	if($preload == "true") {
 	$preload = 'preload';
	} else {
	$preload = '';
	}
 
	return '
	
	<div class="sc-image '.$align.' '.$preload.'" style="'.$position.' '.$top_position.' '.$bottom_position.' '.$left_position.' '.$right_position.' margin: '.$mtop.'px '.$mright.'px '.$mbottom.'px '.$mleft.'px; width: '.$width.'px; '.$image_padding.'">'.$link1.'
		
		'.$lightbox_hover.'
		
		<img class="image '.$preload.'" src="'.$url.'" alt="'.$alt.'" style="width: '.$width.'px; height: '.$height.'px;" />'.$link2.'
		
	</div>
	
	';

}

add_shortcode("image", "ghostpool_image");

?>