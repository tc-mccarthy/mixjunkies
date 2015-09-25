<?php

//*************************** Notifications ***************************//

function ghostpool_notification($atts, $content = null, $code) {
    extract(shortcode_atts(array(
		'type' => '',
    ), $atts));
    
    // Divider
    if($type == "star") {
    $type = "notify-star";
    } elseif($type == "warning") {
    $type = "notify-warning";
    } elseif($type == "error") {
    $type = "notify-error";    
    } elseif($type == "help") {
    $type = "notify-help";
    } else {
    $type = "notify-success";
    }
    
   return '<div class="notify '.$type.'"><span class="icon"></span>'.do_shortcode($content).'</div>';
   
}
add_shortcode("notification", "ghostpool_notification");

?>