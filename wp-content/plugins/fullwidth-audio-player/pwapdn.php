<?php
session_start();
require('../../../wp-blog-header.php');

include('bitly.php');

global $wpdb;
if($_POST['sts']=='dn'){
//$ids = unserialize(base64_decode($_POST['id']));
$ids = unserialize(base64_decode($_POST['submid']));
$post_id = htmlspecialchars(urldecode($ids['postid']));
//die($ids);
$custom_fields = get_post_custom( $post_id );
//print_r($custom_fields);
$trc = $custom_fields['wpfap_track_url'][0];
$trc = get_bitly_short_url($trc);
echo $trc;
}else{
  $tweet_txt = $_POST['cont'].' '.urldecode($_POST['plnk']);
  require_once('./twitter/twitteroauth/twitteroauth.php');
  require_once('./twitter/config.php');
  
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
  $access_token = $connection->getAccessToken($_SESSION['oauth_verifier']);
  
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'],$access_token['oauth_token_secret']);
  $status = $connection->post('statuses/update', array('status' => $tweet_txt));
  
  $ids = unserialize(base64_decode($_POST['submid']));
  $post_id = htmlspecialchars(urldecode($ids['postid']));
  //die($ids);
  $custom_fields = get_post_custom( $post_id );
  //print_r($custom_fields);
  $trc = $custom_fields['wpfap_track_url'][0];
  $longURL = $custom_fields['wpfap_track_url'][0];
  $trc = get_bitly_short_url($trc);
  echo $trc;
  echo $longURL;
}
//print_r($custom_fields);
?>