<?php 
session_start();
require('../../../wp-blog-header.php');
global $wpdb;

require_once('./twitter/twitteroauth/twitteroauth.php');
require_once('./twitter/config.php');
$ppurlt = plugins_url('pwap-sc2.php?id='.$_GET['id'], __FILE__);
define('OAUTH_CALLBACK', $ppurlt);

//echo CONSUMER_KEY;
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$oauth_token = $_GET['oauth_token'];

if($oauth_token==''){
  $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
  $token = $request_token['oauth_token'];
  $_SESSION['oauth_token'] = $request_token['oauth_token'];
  $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
  $oAuthToken = $_SESSION['oauth_token'];
  $oAuthSecret = $_SESSION['oauth_token_secret'];
  //print_r($request_token);
  $url = $connection->getAuthorizeURL($token);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mixjunkies Download</title>
<link href='http://fonts.googleapis.com/css?family=Roboto:900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://www.mixjunkies.com/wp-content/themes/tarnished/css/reset.css" media="screen" />
<link rel="stylesheet" href="http://www.mixjunkies.com/wp-content/themes/tarnished/css/pwap.css?ver1" media="screen" />
<script>
function popup(url)
	{
		window.open(url, "mixjunkies","width=760, height=450");    
	}
  jQuery(document).ready(function() {
    jQuery('.popupwindow').popupWindow({ 
      //windowURL:\''.$ppurl.'\', 
      windowName:'Mixjunkies',
      centerScreen:1,
      height: 450,
      width:780
    });
  });
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1968464-33']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setCustomVar',
      1,                   // This custom var is set to slot #1.  Required parameter.
      'Download',           // The top-level name for your online content categories.  Required parameter.
      'Initial',  // Sets the value of "Section" to "Life & Style" for this particular aricle.  Required parameter.
      3                    // Sets the scope to page-level.  Optional parameter.
   ]);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
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
googletag.defineSlot('/1103149/mixjunkies_728x90', [728, 90], 'div-gpt-ad-1379530031801-4').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
</head>

<body style="background-color:#000;">
<form id="frmsc1" method="post">
<div id="wrap">
<div id="header">
<img id="logo" src="http://www.mixjunkies.com/wp-content/uploads/2013/01/mixjunkies-logo.png"/>
<img id="download" width="227" height="40" src="http://www.mixjunkies.com/wp-content/uploads/2013/01/download.png"/>
</div>
<?php
$ids = unserialize(base64_decode($_GET['id']));
$post_id = htmlspecialchars(urldecode($ids['postid']));
$track_post = get_post( $post_id );
$custom_fields = get_post_custom( $post_id );
$title = $track_post->post_title;
$post_text = str_replace('[fap_track layout=\'list\' enqueue=\'no\']', '', $track_post->post_content);
$post_cont = preg_replace("/<img[^>]+\>/i", " ", $post_text); 
$img_src = $custom_fields['ghostpool_thumbnail'][0];
//$ppurlt = plugins_url('pwap-sc2.php?id='.$_GET['id'], __FILE__);
$ppurlf = plugins_url('pwap-sc3.php?id='.$_GET['id'], __FILE__);
?>
<div id="main">
    	<img src="<?php echo $img_src; ?>" alt="" title="trancepodium-6th-birthday" width="250" height="250" class="alignleft" />

      <div class="inner"><h1><?php echo $title?></h1>
      <p>Download for <strong>FREE</strong>, all we ask is spread the love and share the post.</p>
      <p>Click one of the buttons below to connect with Twitter or Facebook. Post or tweet and start your free download.</p>
      <div id="btns">
      <a href="<?php echo $url;?>" class="tweet popupwindow"><span></span>TWEET &amp DOWNLOAD</a>
      <a href="<?php echo $ppurlf;?>" class="fb popupwindow"><span></span> POST &AMP; DOWNLOAD</a>
    </div>
    </div>
</div>
<div id="ad">
	<!-- mixjunkies_728x90 -->
<div id='div-gpt-ad-1379530031801-4' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379530031801-4'); });
</script>
</div>
</div>
</div>
</form>
<!-- Quantcast Tag -->
<script type="text/javascript">
	var _qevents = _qevents || [];
	
	(function() {
	var elem = document.createElement('script');
	elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
	elem.async = true;
	elem.type = "text/javascript";
	var scpt = document.getElementsByTagName('script')[0];
	scpt.parentNode.insertBefore(elem, scpt);
	})();
	
	_qevents.push({
	qacct:"p-58f7ovbkhWYW2"
	});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-58f7ovbkhWYW2.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->
</body>
</html>