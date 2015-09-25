<?php

//*************************** Register Form ***************************//

function ghostpool_register($atts, $content = null) {
	extract(shortcode_atts(array(
		'username' => gp_username,
		'email' => gp_email,
		'redirect' => 'wp-login.php?action=register'
	), $atts));

	global $user_ID, $user_identity, $user_level;
	
	if($username == "") {
	$username = gp_username;
	}
	
	if($email == "") {
	$email = gp_email;
	}
	
	if($redirect == "") {
	$redirect = site_url($redirect, 'login_post');
	}
	
	if (is_user_logged_in()) {} else {
	
	return
	
	'<form id="registerform" action="'.site_url($redirect, 'login_post').'" method="post">
		<p class="login-username"><input type="text" name="user_login" id="user_register" class="input" value="'.esc_attr(stripslashes($user_login)).'" size="22" /><label>'.gp_username.'</label></p>
		<p class="login-email"><input type="text" name="user_email" id="user_email" class="input" value="'.esc_attr(stripslashes($user_email)).'" size="22" /><label>'.gp_email.'</label></p>			
		'.do_action('register_form').'
		<p>'.gp_email_password.'</p>
		<p><input type="submit" name="wp-submit" id="wp-register" value="'.gp_register.'" tabindex="100" /></p>
	</form>';	
	
	}

}

add_shortcode("register", "ghostpool_register");

?>