<?php

//*************************** Dropcaps ***************************//

function ghostpool_dropcap_1($atts, $content = null) {
	extract(shortcode_atts(array(
        'color'      => ''
    ), $atts));

	$out .= '<span class="dropcap1" style="color: '.$color.';">'.do_shortcode($content).'</span>';

   return $out;
}
add_shortcode('dropcap_1', 'ghostpool_dropcap_1');

function ghostpool_dropcap_2($atts, $content = null) {
	extract(shortcode_atts(array(
        'color'      => '',
    ), $atts));

	$out .= '<span class="dropcap2" style="color: '.$color.';">'.do_shortcode($content).'</span>';

   return $out;
}
add_shortcode('dropcap_2', 'ghostpool_dropcap_2');

function ghostpool_dropcap_3($atts, $content = null) {
	extract(shortcode_atts(array(
        'color'      => '',
    ), $atts));

	$out .= '<span class="dropcap3" style="color: '.$color.';">'.do_shortcode($content).'</span>';

   return $out;
}
add_shortcode('dropcap_3', 'ghostpool_dropcap_3');

function ghostpool_dropcap_4($atts, $content = null) {
	extract(shortcode_atts(array(
        'color'      => '',
    ), $atts));

	$out .= '<span class="dropcap4" style="color: '.$color.';">'.do_shortcode($content).'</span>';

   return $out;
}
add_shortcode('dropcap_4', 'ghostpool_dropcap_4');

function ghostpool_dropcap_5($atts, $content = null) {
	extract(shortcode_atts(array(
        'color'      => '',
    ), $atts));

	$out .= '<span class="dropcap5" style="color: '.$color.';">'.do_shortcode($content).'</span>';

   return $out;
}
add_shortcode('dropcap_5', 'ghostpool_dropcap_5');

?>