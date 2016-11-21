<?php
  $access_token = 'Yh9WBt5/mhi9VnFR3EPckw23Bd5hnm3zinl+danH68ntVDqA/LUOwAprQf3lZQEoYkNZMng7Hdaw5OLD+lTb2xjIAYp2EIVPtuZj8D4B4Au3JWklZSJ50Rlcen5jc3JqaTJci5ZLCTuY3RAPZ5ZK6wdB04t89/1O/w1cDnyilFU=';

  $url = 'https://api.line.me/v1/oauth/verify';

  $headers = array('Authorization: Bearer ' . $access_token);

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $result = curl_exec($ch);
  curl_close($ch);

  echo $result;
?>
