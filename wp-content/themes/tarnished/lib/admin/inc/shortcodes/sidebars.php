<?php

//*************************** Sidebar ***************************//

function ghostpool_sidebar($atts, $content = null) {
	extract(shortcode_atts(array(
        'name' => 'Default Sidebar',
        'width' => '',
        'align' => 'alignnone',
    ), $atts));
	
	ob_start(); ?>
	
	<div class="sc-sidebar <?php echo($align); ?>" style="width: <?php echo($width); ?>px"><?php dynamic_sidebar($name); ?></div>

<?php 

	$output_string = ob_get_contents();
	ob_end_clean(); 
	
	return $output_string;

}

add_shortcode("sidebar", "ghostpool_sidebar");

?>