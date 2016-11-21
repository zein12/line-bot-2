<?php

  $cid = '1489175380';
  $csc = '5dba7b5e31d22c110ae84c75f82b90f4';
  $token = 'Yh9WBt5/mhi9VnFR3EPckw23Bd5hnm3zinl+danH68ntVDqA/LUOwAprQf3lZQEoYkNZMng7Hdaw5OLD+lTb2xjIAYp2EIVPtuZj8D4B4Au3JWklZSJ50Rlcen5jc3JqaTJci5ZLCTuY3RAPZ5ZK6wdB04t89/1O/w1cDnyilFU=';

  $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
  $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $csc]);

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Line Bot</title>
</head>
<body>

</body>
</html>
