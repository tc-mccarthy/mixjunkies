<?php 

//*************************** Page Skin ***************************//

// Individual Skin Settings
if(is_singular() && get_post_meta($post->ID, 'ghostpool_skin', true) == "Pink") {
	$page_skin = "pink";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_skin', true) == "Red") {
	$page_skin = "red";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_skin', true) == "Green") {
	$page_skin = "green";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_skin', true) == "Brown") {
	$page_skin = "brown";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_skin', true) == "Orange") {
	$page_skin = "orange";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_skin', true) == "Silver") {
	$page_skin = "silver";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_skin', true) == "Blue") {
	$page_skin = "blue";
} else {

	// Default Global Skin Settings
	if($theme_skin == "Pink") {
		$page_skin = "pink";
	} elseif($theme_skin == "Red") {
		$page_skin = "red";
	} elseif($theme_skin == "Green") {
		$page_skin = "green";
	} elseif($theme_skin == "Brown") {
		$page_skin = "brown";
	} elseif($theme_skin == "Orange") {
		$page_skin = "orange";
	} elseif($theme_skin == "Silver") {
		$page_skin = "silver";
	} elseif($theme_skin == "Blue") {
		$page_skin = "blue";
	}	
	
}


//*************************** Page Background ***************************//

// Individual Background Settings
if(is_singular() && get_post_meta($post->ID, 'ghostpool_bg', true) == "Pink Stripes") {
	$page_bg = "pink-stripes";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_bg', true) == "Royal Blue") {
	$page_bg = "royal-blue";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_bg', true) == "Dark Blue") {
	$page_bg = "dark-blue";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_bg', true) == "Black") {
	$page_bg = "black";
} elseif(is_singular() && get_post_meta($post->ID, 'ghostpool_bg', true) == "Cream") {
	$page_bg = "cream";
} else { 

	// Default Global Background Settings
	if($theme_bg == "Pink Stripes") {
		$page_bg = "pink-stripes";
	} elseif($theme_bg == "Royal Blue") {
		$page_bg = "royal-blue";
	} elseif($theme_bg == "Dark Blue") {
		$page_bg = "dark-blue";
	} elseif($theme_bg == "Black") {
		$page_bg = "black";
	} elseif($theme_bg == "Cream") {
		$page_bg = "cream";
	}

}


//*************************** Theme Options Switcher ***************************//

if($theme_theme_options_box == "1") {
	
	// Page Skin Switcher 
	if(isset($_COOKIE['ghostpool-tarnished-skin'])) {
		$page_skin = $_COOKIE['ghostpool-tarnished-skin']; 
	}
	if(isset($_GET['skin'])) {
		$page_skin = $_GET['skin'];
		setcookie('ghostpool-tarnished-skin', $page_skin);
	} 
	
	// Page Background Switcher
	if(isset($_COOKIE['ghostpool-tarnished-bg'])) {
		$page_bg = $_COOKIE['ghostpool-tarnished-bg']; 
	}
	if(isset($_GET['bg'])) {
		$page_bg = $_GET['bg'];
		setcookie('ghostpool-tarnished-bg', $page_bg);
	} 
	
	// Defaults
	if($_GET['style'] == "default") {
		setcookie('ghostpool-tarnished-skin', $page_skin, time()-3600);
		setcookie('ghostpool-tarnished-bg', $page_bg, time()-3600);
	} ?>
	
<?php } ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style-<?php echo $page_skin; ?>.css" media="screen" />	

	<style>body {background: url(<?php bloginfo('template_directory'); ?>/images/page-bg-<?php echo $page_bg; ?>.png) repeat;}</style>
	
<?php endwhile; else : ?>

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style-<?php echo $page_skin; ?>.css" media="screen" />	

	<style>body {background: url(<?php bloginfo('template_directory'); ?>/images/page-bg-<?php echo $page_bg; ?>.png) repeat;}</style>
	
<?php endif; ?>	