<?php
require('../../../wp-blog-header.php');
include('bitly.php');
session_start();
global $wpdb;

$ids = unserialize(base64_decode($_GET['id']));
$post_id = htmlspecialchars(urldecode($ids['postid']));
$track_post = get_post( $post_id );
$custom_fields = get_post_custom( $post_id );
$title = $track_post->post_title;
$post_text = str_replace('[fap_track layout=\'list\' enqueue=\'no\']', '', $track_post->post_content);
$post_text = preg_replace("/<img[^>]+\>/i", " ", $post_text);
$tweet_txt = $custom_fields['wpfap_tweet_text'][0];
$img_src = $custom_fields['ghostpool_thumbnail'][0];
$_SESSION["oauth_verifier"] = $_GET["oauth_verifier"];
$longURL = $custom_fields['wpfap_track_url'][0];

$post_url = get_bitly_short_url(get_permalink( $post_id ));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mixjunkies Download</title>
<link href='http://fonts.googleapis.com/css?family=Roboto:900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://www.mixjunkies.com/wp-content/themes/tarnished/css/reset.css" media="screen" />
<link rel="stylesheet" href="http://www.mixjunkies.com/wp-content/themes/tarnished/css/pwap.css?ver2" media="screen" />
<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('#tweetpost').click(function (){
    var cnt = $('#tweet').val();
    var lks = $('#tweetlnks').val();
    if(confirm('You will tweet: '+cnt+' '+lks)){
    var url = '<?php echo plugins_url();?>/fullwidth-audio-player/pwapdn.php';
    $.post(url, { sts: "dnt", submid: "<?php echo $_GET['id']; ?>", cont: cnt, plnk: lks }, function(data){
      var urls = data;
	  var longUrl = "<?php echo $longURL ?>";
      var dnbl = document.getElementById('tweettodownload');
      $('#tweettodownload').attr( 'href',  longUrl );
      $('#tweettodownload').attr('onclick',  '');
      dnbl.style.opacity = 1;
      dnbl.style.cursor = 'pointer';
      $('#innerdv').html('<h1> Thanks for spreading the love!</h1><p>You shared the post</p><p>Click the button below to download <br/> <strong><?php echo addslashes($title);?></strong></p>');
      $('#tweetpost').hide();
	  $('.dl').removeClass('disabled').addClass('big');
    });
    }else{return false;}
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
      'Tweet',  // Sets the value of "Section" to "Life & Style" for this particular aricle.  Required parameter.
      3                    // Sets the scope to page-level.  Optional parameter.
   ]);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
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
<form id="frmsc2" method="post">

<div id="wrap">
<div id="header">
<img id="logo" src="http://www.mixjunkies.com/wp-content/uploads/2013/01/mixjunkies-logo.png">
<img id="download" width="227" height="40" src="http://www.mixjunkies.com/wp-content/uploads/2013/01/download.png"/>
</div>
<div id="main">
      <img src="<?php echo $img_src; ?>" alt="" title="trancepodium-6th-birthday" width="250" height="250" class="alignleft" />
      <div class="inner"><div id="innerdv">
      <h1><?php echo $title?></h1>
      <p>Tweet then click "Download". Much love for the support!</p>
      <input name="tweet" type="text" id="tweet" value="<?php echo $tweet_txt;?>" />
      <input name="lnks" type="hidden" id="tweetlnks" value="<?php echo $post_url;?>" />
      <p class="link"><strong>LINK:</strong> <?php echo $post_url; ?></p>
      </div>
      <div id="btns" style="padding-bottom:12px;">
<!--      <a href="http://twitter.com/intent/tweet?text=<?php echo $tweet_txt; ?>&url=<?php echo $post_url; ?>" class="tweet it" data-text="post data text"><span></span>TWEET IT UP</a>-->
      <a id="tweetpost" onClick="return false" class="tweet it"><span></span>TWEET IT UP</a>
      <a id="tweettodownload" onClick="return false" class="dl disabled"><span></span> DOWNLOAD NOW</a>
    </div>
    <a href="https://twitter.com/Mixjunkies" class="twitter-follow-button" data-show-count="false">Follow @Mixjunkies</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div></div>
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