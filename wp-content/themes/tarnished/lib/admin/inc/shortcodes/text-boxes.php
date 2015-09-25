<?php

//*************************** Text Boxes ***************************//

function ghostpool_text($atts, $content = null) {
	extract(shortcode_atts(array(
        'size' => '13',
        'width' => '100%',
        'height' => '',
        'line_height' => '19px',
        'top' => '0px',
        'bottom' => '0px',
        'right' => '0px',
        'left' => '0px',
        'color' => '',
        'font' => "Arial, Tahoma, 'Lucida Sans Unicode', 'Lucida Grande'",
        'text_align' => 'text-left',
        'other' => ''
    ), $atts));

	if($right == "auto" OR $left == "auto") {
	$centered_class = 'centered';
	} else {
	$centered = '';
	}

	$out = '
	
	<div class="text-box '.$text_align.' '.$centered_class.'" style="font-size: '.$size.'px; color: '.$color.'; font-family: '.$font.'; line-height: '.$line_height.'; margin: '.$top.' '.$right.' '.$bottom.' '.$left.'; width: '.$width.'; height: '.$height.'; '.$other.'">'.do_shortcode($content).'</div>';

   return $out;
}

add_shortcode('text', 'ghostpool_text');

?>