<?php
function get_bitly_short_url($url,$login='mixjunkies',$appkey='R_65a8398072ee08136a55a9c5baaae10f',$format='txt') {
  $connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.$url.'&format='.$format;
  return curl_get_result($connectURL);
  return $url;
}

function curl_get_result($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
?>