<?php

//*************************** Toggle Boxes ***************************//

function ghostpool_toggle($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<h3 class="toggle"><a href="#">' .$title. '</a></h3>';
	$out .= '<div class="toggle-box" style="display: none;"><p>';
	$out .= do_shortcode($content);
	$out .= '</p></div>';

   return $out;
}

add_shortcode('toggle', 'ghostpool_toggle');

?>