<?php

/*************************** File Directories ***************************/

define(ghostpool_inc, TEMPLATEPATH . '/lib/inc/');
define(ghostpool_scripts, TEMPLATEPATH . '/lib/scripts/');
define(ghostpool_admin, TEMPLATEPATH . '/lib/admin/inc/');


/*************************** Additional Functions ***************************/

// Main Theme Options
require_once(ghostpool_admin . 'theme-options.php');

// Meta Options
require_once(ghostpool_admin . 'theme-meta-options.php');

// Widgets
require_once(ghostpool_admin . 'theme-widgets.php');

// Sidebars
require_once(ghostpool_admin . 'theme-sidebars.php');

// Shortcodes
require_once(ghostpool_admin . 'theme-shortcodes.php');

// Custom Post Types
require_once(ghostpool_admin . 'theme-post-types.php');

// Language
require_once(ghostpool_inc . 'language.php');

// TinyMCE
require_once (ghostpool_admin . 'tinymce/tinymce.php');

// WP Show IDs
require_once(ghostpool_scripts . 'wp-show-ids/wp-show-ids.php');

// Image Resizer
require_once(ghostpool_scripts . 'image-resizer.php');

// Update Notification
require_once(ghostpool_admin . 'theme-update-notification.php');


/*************************** Featured Image Sizes ***************************/

/*
add_theme_support('post-thumbnails');
get_option('thumbnail_crop');
add_image_size('thumbnail', 120, 120, true);
*/


/*************************** Featured Image Sizes ***************************/

add_theme_support('automatic-feed-links');


/*************************** Navigation Menus ***************************/

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
register_nav_menus(array(
'header-nav' => __( 'Header Navigation' )
));
}


/*************************** Custom Background Support ***************************/

add_custom_background();

/*************************** Embed Size Change ***************************/

function mycustom_embed_defaults($embed_size){
    if( is_single() ){ // If displaying a single post
        $embed_size['width'] = 580; // Adjust values to your needs
        //$embed_size['height'] = 326; 
    }
     
    return $embed_size; // Return new size
}
 
add_filter('embed_defaults', 'mycustom_embed_defaults');


/*************************** Excerpts ***************************/

// WordPress Excerpt Length
function new_excerpt_length($length) {return 500;}
add_filter('excerpt_length', 'new_excerpt_length');

function excerpt($limit) {
$excerpt = explode(' ', get_the_excerpt(), $limit);
if (count($excerpt)>=$limit) {
array_pop($excerpt);
$excerpt = implode(" ",$excerpt).'...';
} else {
$excerpt = implode(" ",$excerpt);
}	
$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
return $excerpt;
}

// Replace Excerpt Ellipsis
function new_excerpt_more($more) {
return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
remove_filter('the_excerpt', 'wpautop');


/*************************** Shortcode Support For Text Widget ***************************/

add_filter('widget_text', 'do_shortcode');

/*************************** Author Box Additions ***************************/

function wptuts_contact_methods( $contactmethods ) {
 
    // Remove we what we don't want
    unset( $contactmethods[ 'aim' ] );
    unset( $contactmethods[ 'yim' ] );
    unset( $contactmethods[ 'jabber' ] );
 
    // Add some useful ones
    $contactmethods[ 'twitter' ] = 'Twitter Username';
    $contactmethods[ 'facebook' ] = 'Facebook Profile URL';
    $contactmethods[ 'googleplus' ] = 'Google+ Profile URL';
 
    return $contactmethods;
}
 
add_filter( 'user_contactmethods', 'wptuts_contact_methods' );


/*************************** Page Navigation ***************************/

function gp_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     
	 if (get_query_var('paged')) {
		 $paged = get_query_var('paged');
	 } elseif (get_query_var('page')) {
		 $paged = get_query_var('page');
	 } else {
		 $paged = 1;
	 }

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
	
     if(1 != $pages)
     {
        echo "<div class='wp-pagenavi'>";
		echo '<span class="pages">'.gp_page.' '.$paged.' '.gp_of.' '.$pages.'</span>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/*************************** Shorten Title Text ***************************/

function related_title($text) {
	$chars_limit = 40;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit) {
	$text = $text."...";
	}
	return $text;
}


/*************************** Password Protected Form ***************************/

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
global $post;
$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
$form =  '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
' . gp_password_protected. '<br/><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
</form>';
return $form;
}


/*************************** Custom Media Gallery Field ***************************/

function ghostpool_attachment_fields_to_edit($form_fields, $post) {
	$form_fields["ghostpool_gallery_video_url"] = array(
		"label" => __("Video URL"),
		"input" => "text",
		"value" => get_post_meta($post->ID, "_ghostpool_gallery_video_url", true),
        "helps" => __("To be used when this image is displayed <u>within</u> the lightbox on portfolio pages."),
	);
   return $form_fields;
}
add_filter("attachment_fields_to_edit", "ghostpool_attachment_fields_to_edit", null, 2);

function ghostpool_attachment_fields_to_save($post, $attachment) {
	if( isset($attachment['ghostpool_gallery_video_url']) ){
		update_post_meta($post['ID'], '_ghostpool_gallery_video_url', $attachment['ghostpool_gallery_video_url']);
	}
	return $post;
}
add_filter("attachment_fields_to_save", "ghostpool_attachment_fields_to_save", null , 2);


/*************************** Redirect to Theme Options after Activation ***************************/

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
add_action('admin_head','ct_option_setup');
header( 'Location: '.admin_url().'admin.php?page=theme-options.php' ) ;
}


/*************************** CSS3PIE Behaviour For IE Elements ***************************/

function render_ie_pie() {
echo '
<!--[if lte IE 8]>
<style>
h1,h2,h3,h4,h5,h6,
.dropcap2,
.dropcap3,
.dropcap4,
.dropcap5,
.notify,
#nav .sub-menu,
.caption-overlay
{
behavior: url("'.get_bloginfo('template_url').'/lib/scripts/pie/PIE.php");
}
</style>
<![endif]-->';
}
add_action('wp_head', 'render_ie_pie', 8);


/*************************** Thickbox Image Path Fix ***************************/

add_action('wp_footer', 'load_tb_fix');
function load_tb_fix() {
	echo '<script type="text/javascript">tb_pathToImage = "' . get_bloginfo('url') . '/wp-includes/js/thickbox/loadingAnimation.gif";
	tb_closeImage = "' . get_bloginfo('url') . '/wp-includes/js/thickbox/tb-close.png";</script>';
}

?>