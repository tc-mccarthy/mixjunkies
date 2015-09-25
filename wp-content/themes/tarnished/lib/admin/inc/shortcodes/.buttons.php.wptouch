<?php

//*************************** Buttons ***************************//

function ghostpool_button($atts, $content = null) {
    extract(shortcode_atts(array(
        'link' => '#',
        'color' => 'darkgrey'
    ), $atts));

	$out = '<div class="button-wrapper"><div class="button '.$color.'"><a href="'.$link.'">'.do_shortcode($content).'</a></div></div>';
    
    return $out;
}

add_shortcode('button', 'ghostpool_button');

?>