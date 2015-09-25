<?php
/*
Plugin Name: Category Redirect to Post or Page
Plugin URI: http://www.ecigsavings.com
Description: Plugin for redirecting categories to different URLs such as a post or a page. Very useful for themes that only allow categories or pages to be added to a menu bar when you want to use posts that way you can create the category add it to the menu and which this plugin when its clicked the user will be directed straight to the full post you assigned to that category rather than the category page.
Author: Christopher Long (http://www.ecigsavings.com)
Version: 2.3
Author URI: http://www.ecigsavings.com
*/

### SET THE ADMIN MENU ##
function CatRedr_Admin_Menu(){
	add_options_page("Category Redirect", "Category Redirect", 1, "Category-Redirect", "CatRedr_Admin_Form");
}

## CREATE NEW TABLE TO STORE REDIRECT LINK ##
function DB_Install(){
	global $wpdb;
	require_once(ABSPATH. 'wp-admin/includes/upgrade.php' );
   $table = $wpdb->prefix."cat_redirect";
	$structure = "CREATE TABLE IF NOT EXISTS $table (
  			`id` mediumint(10) NOT NULL AUTO_INCREMENT,
  			`cat_id` mediumint(10) NOT NULL,
  			`url` text NOT NULL,
  			PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
  	dbDelta($structure);
}



### GET THE CATEGORY REDIRECT LINK FROM DB ##
function Cat_redirect_Link($catID){
	global $wpdb;
	$SQL = "SELECT * FROM ". $wpdb->prefix."cat_redirect". " WHERE `cat_id` = '$catID'";
	$Result =  $wpdb->get_results($SQL,OBJECT);
	return $Result[0]->url;
}



###  MAIN FUNCTION TO SHOW CATEGORY LINK ##
function PrePare_Cat_Link($LINK,$Cat_ID){

	$Cat_Link = Cat_redirect_Link($Cat_ID);

	if($Cat_Link==''){
		$Cat_Link = $LINK;
	}

	return $Cat_Link;

}


## SET THE ADMIN PANEL TO CHANGE OR SET CAT REDRIRECT URL ###
function CatRedr_Admin_Form(){

	global $wpdb;

    include('cat_form.php');

}


## CATGEORY LINK
add_filter('category_link', 'PrePare_Cat_Link' ,10 ,2);
## INSTALL DB
// add_action('activate_category_redirect/category_redirect.php', 'DB_Install');
register_activation_hook( __FILE__,'DB_Install');
## CREATE ADMIN MENU
add_action('admin_menu', 'CatRedr_Admin_Menu');


?>