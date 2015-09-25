<?php

//*************************** Login Form ***************************//

function ghostpool_login($atts, $content = null) {
	extract(shortcode_atts(array(
		'username' => gp_username,
		'password' => gp_password,
		'redirect' => site_url( $_SERVER['REQUEST_URI'] )
	), $atts));
	
	if($username == "") {
	$username = gp_username;
	}
	
	if($password == "") {
	$password = gp_password;
	}
	
	if($redirect == "") {
	$redirect = site_url( $_SERVER['REQUEST_URI'] );
	}

	$args = array(
	'redirect' => $redirect,
	'label_username' => __($username),
	'label_password' => __($password),
	'remember' => true
	);
	
	ob_start(); ?>
     
	<?php if (is_user_logged_in()) {} else {
	
		wp_login_form($args);
	
	}

	$output_string = ob_get_contents();
	ob_end_clean(); 
	
	return $output_string;
}

add_shortcode("login", "ghostpool_login");

?>