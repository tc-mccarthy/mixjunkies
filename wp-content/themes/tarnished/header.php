<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js">
<head>
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
<meta charset=<?php bloginfo('charset'); ?> />
<title><?php bloginfo('name'); ?> | <?php is_home() || is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

<?php require(ghostpool_inc . 'options.php'); ?>

<link href='http://fonts.googleapis.com/css?family=Roboto:900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?ver=6" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css" media="screen" />

<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style-ie.css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style-ie7.css" media="screen" /><![endif]-->

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if($theme_favicon_ico) { ?><link rel="icon" href="<?php echo($theme_favicon_ico); ?>" type="image/vnd.microsoft.icon" />
<link rel="SHORTCUT ICON" href="<?php echo($theme_favicon_ico); ?>" /><?php } ?>
<?php if($theme_favicon_png) { ?><link rel="icon" type="image/png" href="<?php echo($theme_favicon_png); ?>" /><?php } ?>
<?php if($theme_apple_icon) { ?><link rel="apple-touch-icon" href="<?php echo($theme_apple_icon); ?>" /><?php } ?>
<?php $image = vt_resize(get_post_thumbnail_id(), get_post_meta($post->ID, 'ghostpool_thumbnail', true), $image_width, $image_height, true); ?>
<meta name="thumbnail" content="<?php echo $image[url]; ?>" />
<meta name="og:image" content="<?php echo $image[url]; ?>" />
<meta name="msvalidate.01" content="CDC9F52574171BDF86FB4F6D9887A6F0" />

<?php /*?><?php require(ghostpool_inc . 'skins.php'); ?>

<?php require(ghostpool_inc . 'styling.php'); ?><?php */?>

<?php
wp_enqueue_script('jquery');
if(is_singular()) wp_enqueue_script('comment-reply');
wp_enqueue_script('jquery-ui-accordion');
wp_enqueue_script('jquery-ui-tabs');
?>
<?php wp_head(); ?>

<?php /*?><?php if($theme_custom_css) { ?><style><?php echo stripslashes($theme_custom_css); ?></style><?php } ?><?php */?>

<script src="<?php bloginfo('template_directory'); ?>/lib/scripts/mediaplayer/jwplayer.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.kwicks-1.5.1.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/simple-share.js?ver=14" type="text/javascript"></script>
<script>var rootFolder='<?php bloginfo('template_directory'); ?>';</script>

<?php echo stripslashes($theme_scripts); ?>

<?php if(is_front_page()) { ?><meta property="fb:app_id" content="220389547977520" /><?php } ?>

<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/1103149/mixjunkie_skin', [1, 1], 'div-gpt-ad-1379530031801-0').addService(googletag.pubads());
googletag.defineSlot('/1103149/mixjunkies_160x600', [160, 600], 'div-gpt-ad-1379530031801-1').addService(googletag.pubads());
googletag.defineSlot('/1103149/mixjunkies_300x250', [300, 250], 'div-gpt-ad-1379530031801-2').addService(googletag.pubads());
googletag.defineSlot('/1103149/mixjunkies_300X600', [300, 600], 'div-gpt-ad-1379530031801-3').addService(googletag.pubads());
googletag.defineSlot('/1103149/mixjunkies_728x90', [728, 90], 'div-gpt-ad-1379530031801-4').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<?php /*
*/?>
	
</head>		
			
<body <?php body_class( $class ); ?>>
<? /*<center style="margin:-26px 0 -54px">
<!--begin pushdown-->
<img src="http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=tf&c=19&mc=imp&pli=10184746&PluID=0&ord=%%CACHEBUSTER%%&rtu=-1">
<SCRIPT language='JavaScript1.1' SRC="http://ad.doubleclick.net/adj/N4811.BTN/B8162761;sz=970x66;ord=%%CACHEBUSTER%%?">
</SCRIPT>
<NOSCRIPT>
<A HREF="http://ad.doubleclick.net/jump/N4811.BTN/B8162761;sz=970x66;ord=%%CACHEBUSTER%%?">
<IMG SRC="http://ad.doubleclick.net/ad/N4811.BTN/B8162761;sz=970x66;ord=%%CACHEBUSTER%%?" BORDER=0 WIDTH=970 HEIGHT=66 ALT="Advertisement"></A>
</NOSCRIPT>
<!--end pushdown-->
</center>
 */?>
    <?php /*<div style="padding:6px;background:#ce0808;color:#FFF;" id="alert"><p>We are currently having issues with our audio content. We will have a fix up soon. Sorry junkies :( </p></div> */?>
<script>
	var el = document.getElementsByTagName("html")[0];
	el.className = "";
</script>

<?php if($theme_theme_options_box == "1") { require(ghostpool_inc . 'theme-options-box.php'); } ?>

<a href="#top_arrow"></a>

<div class="<?php if(function_exists('is_admin_bar_showing') && is_admin_bar_showing()) { ?>header-admin-bar<?php } ?>"></div>
<div id="leader" class="banner">
<?php echo do_shortcode("[sam id=3 codes='false']");?>
</div>
  
<!--Begin Header-->
	<div id="header">
		<div class="inner">
		<!--Begin Logo-->
		<div id="logo">
			
			<?php if($theme_custom_logo_text) { ?><h1><a href="<?php bloginfo('url'); ?>/"><?php echo $theme_custom_logo_text; ?></a></h1><?php } else { ?><?php if($theme_custom_logo) { ?><a href="<?php bloginfo('url'); ?>/"><img src="<?php echo($theme_custom_logo); ?>"></a><?php } else { ?><a href="<?php bloginfo('url'); ?>/"><span></span></a><?php } ?><?php } ?>

		</div>
		<!--End Logo-->
		<!--Begin Header Widget-->
		<?php if(is_active_sidebar('header')) { ?>
			<div id="header-widget">
				<?php dynamic_sidebar('header'); ?>
			</div>
		<?php } ?>
		<!--End Header Widget-->
        <div id="smedia"><a id="face" target="_blank" class="socials" href="http://www.facebook.com/Mixjunkies"><span class="icon"></span><span class="join">JOIN US ON</span>FACEBOOK</a>
        <a id="twit" class="socials" href="http://twitter.com/intent/user?screen_name=mixjunkies"><span class="icon"></span><span class="join">FOLLOW US ON</span>TWITTER</a></div>
        
		<?php if($theme_search_form == "1") {} else { get_search_form(); } ?>

 <!--Begin Nav-->
            <div id="nav">
                <?php wp_nav_menu('sort_column=menu_order&container=ul&theme_location=header-nav&fallback_cb=null'); ?>    
            </div>
	     <!--End Nav-->
        </div>
        <!-- END INNER -->
	</div>	
 
	<!--End Header-->
 
    <div id="feedback">
        <div class="inner">
        <div class="canv">FEEDBACK</div>
        <a href="javascript: void(0)" class="btn close">X</a>
            <?php echo do_shortcode("[contact-form-7 id='12758' title='Feedback']"); ?> 
        </div>
    </div>
<!-- END FEEDBACK -->
<!--Begin Page Wrapper-->
<div id="page-wrapper">
	
	
			
	<div class="clear"></div>