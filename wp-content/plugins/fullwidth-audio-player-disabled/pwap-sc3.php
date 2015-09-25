<?php
require('../../../wp-blog-header.php');
//include('bitly.php');

global $wpdb;

$ids = unserialize(base64_decode($_GET['id']));
$post_id = htmlspecialchars(urldecode($ids['postid']));
$track_post = get_post( $post_id );
$custom_fields = get_post_custom( $post_id );
$title = $track_post->post_title;
$post_text = str_replace('[fap_track layout=\'list\' enqueue=\'no\']', '', $track_post->post_content);
$post_text = preg_replace("/<img[^>]+\>/i", "", $post_text);
$post_text = trim($post_text);
$post_text = addslashes(nl2br($post_text));
$tweet_txt = $custom_fields['wpfap_tweet_text'][0];
$img_src = $custom_fields['ghostpool_thumbnail'][0];
$longURL = $custom_fields['wpfap_track_url'][0];

//$post_url = get_bitly_short_url(get_permalink( $post_id ));
$post_url = get_permalink( $post_id );


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mixjunkies Download</title>
<link href='http://fonts.googleapis.com/css?family=Roboto:900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://www.mixjunkies.com/wp-content/themes/tarnished/css/pwap.css?ver2" media="screen" />
<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
<style>
.mouse{
	cursor:pointer;
}
</style>
<script src='//connect.facebook.net/en_US/all.js'></script>
<script  type="text/javascript" charset="utf-8"> 
	FB.init({appId: '220389547977520', status: true, cookie: true});
	function postToFeed() { 
    //var lks = $('#posturl').val();
	//console.log(lks);
		var obj = { 
			method: 'feed',
			name: '<?php echo addslashes($title);?>',
			caption: '',
			//description: <?php /*?><?php echo json_encode($post_text);?><?php */?>,
            link: '<?php echo $post_url;?>',
			picture: '<?php echo $img_src; ?>',
			actions: [{ name: 'mixjunkies', link: 'http://www.mixjunkies.com' }]
		}; 
		//alert('after');
	 function callback(response) { 
			if(response!=undefined){ 
				//alert(response);
        var url = '<?php echo plugins_url();?>/fullwidth-audio-player/pwapdn.php';
        $.post(url, { sts: "dn", submid: "<?php echo $_GET['id']; ?>" }, function(data, url){
          var urls = data;
		  var longUrl = "<?php echo $longURL ?>";
          var fbdnld = document.getElementById('posttodownload');
		  //console.log("Long URL: " + longUrl);
          $('#posttodownload').attr( 'href',  longUrl );
          $('#posttodownload').attr('onclick',  '');
          fbdnld.style.opacity = 1;
          fbdnld.style.cursor = 'pointer';
          $('#innerdv').html('<h1>Thanks for spreading the love!</h1><p>You shared the post</p><p>Click the button below to download <br/> <strong><?php echo addslashes($title);?></strong></p>');
          $('#fbpost').hide();
		  $('.dl').removeClass('disabled').addClass('big');
        });
        
				//window.location.assign(url);
			} 
		} 
		FB.ui(obj, callback); 
	} 
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1968464-33']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setCustomVar',
      1,                   // This custom var is set to slot #1.  Required parameter.
      'Download',           // The top-level name for your online content categories.  Required parameter.
      'Facebook',  // Sets the value of "Section" to "Life & Style" for this particular aricle.  Required parameter.
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

<body style="background-color:#000;"><div id="fb-root"></div>
<div id="wrap">
<div id="header">
<img id="logo" src="http://www.mixjunkies.com/wp-content/uploads/2013/01/mixjunkies-logo.png">
<img id="download" width="227" height="40" src="http://www.mixjunkies.com/wp-content/uploads/2013/01/download.png"/>
</div>
<div id="main">
      <img src="<?php echo $img_src; ?>" alt="" title="trancepodium-6th-birthday" width="250" height="250" class="alignleft" />
      <div class="inner"><div id="innerdv">
        <h1><?php echo $title?></h1>
        <p>Post the link to Facebook then click "Download". Much love for the support!</p>
        <input type="hidden" name="posturl" id="posturl" value="<?php echo $post_url;?>" />
        <p class="link"><strong>LINK:</strong> <?php echo $post_url; ?></p>
      </div>
      <div id="btns">
      <a id="fbpost" href="" onClick="postToFeed(); return false;" class="fb it"><span></span>POST ON FACEBOOK<span class="FBConnectButton FBConnectButton_Small" style="cursor:pointer;"></span></a>
      <a id="posttodownload" onClick="return false;" class="dl disabled"><span></span> DOWNLOAD NOW</a>
   </div>
   <!--iframe id="fbLike" src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fmixjunkies&amp;send=false&amp;layout=standard&amp;width=400&amp;show_faces=true&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=80&amp;appId=109027369193826" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px; height:66px;" allowTransparency="true"></iframe-->
</div></div>
<div id="ad">
	<!-- mixjunkies_728x90 -->
<div id='div-gpt-ad-1379530031801-4' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379530031801-4'); });
</script>
</div>
</div>
</body>
</html>